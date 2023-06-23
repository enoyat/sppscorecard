import 'dart:io';

import 'package:dio/dio.dart';
import 'package:flutter/material.dart';
import 'package:google_map/models/invoice.dart';
import 'package:google_map/models/transaction.dart';
import 'package:google_map/widgets/user_imagepicker.dart';

import '../pages/customer/transaction_page.dart';
import '../services/transaction_dio.dart';

class OrderStatusConfirm extends StatefulWidget {
  const OrderStatusConfirm({
    Key? key,
    required this.transaction,
  }) : super(key: key);

  final Transaction transaction;

  @override
  State<OrderStatusConfirm> createState() => _OrderStatusConfirmState();
}

class _OrderStatusConfirmState extends State<OrderStatusConfirm> {
  bool isLoading = false;
  File? pickedImageFile;
  void pickedImage(File image) {
    setState(() {
      pickedImageFile = image;
    });
  }

  String namafilegambar = "";

  Future _upload(File file) async {
    String fileName = file.path.split('/').last;

    FormData formData = FormData.fromMap({
      "image": await MultipartFile.fromFile(
        file.path,
        filename: fileName,
      ),
    });

    Dio dio = Dio();
    setState(() {
      isLoading = true;
    });
    dio
        .post("http://salin.sikocloudtech.or.id/api/apimedia", data: formData)
        .then((value) => setState(() {
              namafilegambar = value.toString();
              _submitTrans();
            }));
  }

  void _onSubmit() {
    setState(() => isLoading = true);
    _upload(pickedImageFile!);
    //_submitTrans();
    Future.delayed(
        const Duration(seconds: 3)
        // ignore: avoid_types_on_closure_parameters
        , () {
      setState(() => isLoading = false);
      Navigator.pushAndRemoveUntil(
        context,
        MaterialPageRoute(
          builder: (BuildContext context) => const TransactionCustomerPage(),
        ),
        (route) => false,
      );
    });
  }

  void _submitTrans() {
    Invoice item = Invoice(
      transactionid: widget.transaction.id,
      image: namafilegambar,
      status: "pending",
    );

    TransactionDio().postInvoice(item);
    Navigator.push(
      context,
      MaterialPageRoute(builder: (context) => const TransactionCustomerPage()),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
        body: SingleChildScrollView(
      child: Column(
        children: [
          Container(
            height: 100,
            margin: const EdgeInsets.all(10),
            decoration: BoxDecoration(
              color: const Color.fromARGB(255, 236, 243, 234),
              borderRadius: BorderRadius.circular(10),
            ),
            child: GridView.count(
              crossAxisCount: 4,
              children: [
                Container(
                  margin: const EdgeInsets.all(5),
                  decoration: BoxDecoration(
                    color: const Color.fromARGB(255, 236, 243, 234),
                    borderRadius: BorderRadius.circular(10),
                  ),
                  child: const Center(
                    child: Column(
                      mainAxisAlignment: MainAxisAlignment.center,
                      crossAxisAlignment: CrossAxisAlignment.center,
                      children: [
                        Center(
                          child: Icon(
                            Icons.cached,
                            color: Colors.black,
                            size: 30,
                          ),
                        ),
                        SizedBox(height: 5),
                        Center(
                          child: Text(
                            "Sedang Diproses",
                            style: TextStyle(
                              color: Colors.grey,
                              fontSize: 13,
                            ),
                            textAlign: TextAlign.center,
                          ),
                        ),
                      ],
                    ),
                  ),
                ),
                Container(
                  margin: const EdgeInsets.all(5),
                  decoration: BoxDecoration(
                    color: const Color.fromARGB(255, 236, 243, 234),
                    borderRadius: BorderRadius.circular(10),
                  ),
                  child: const Center(
                    child: Column(
                      mainAxisAlignment: MainAxisAlignment.center,
                      crossAxisAlignment: CrossAxisAlignment.center,
                      children: [
                        Center(
                          child: Icon(
                            Icons.add_task,
                            color: Color.fromARGB(255, 107, 216, 5),
                            size: 30,
                          ),
                        ),
                        SizedBox(height: 5),
                        Center(
                          child: Text(
                            "Terkonfirmasi Admin",
                            style: TextStyle(
                              color: Color.fromARGB(255, 107, 216, 5),
                              fontSize: 13,
                            ),
                            textAlign: TextAlign.center,
                          ),
                        ),
                      ],
                    ),
                  ),
                ),
                Container(
                  margin: const EdgeInsets.all(5),
                  decoration: BoxDecoration(
                    color: const Color.fromARGB(255, 236, 243, 234),
                    borderRadius: BorderRadius.circular(10),
                  ),
                  child: const Center(
                    child: Column(
                      mainAxisAlignment: MainAxisAlignment.center,
                      crossAxisAlignment: CrossAxisAlignment.center,
                      children: [
                        Center(
                          child: Icon(
                            Icons.archive,
                            color: Colors.black,
                            size: 30,
                          ),
                        ),
                        SizedBox(height: 5),
                        Center(
                          child: Text(
                            "Telah Diterima",
                            style: TextStyle(
                              color: Colors.grey,
                              fontSize: 13,
                            ),
                            textAlign: TextAlign.center,
                          ),
                        ),
                      ],
                    ),
                  ),
                ),
                Container(
                  margin: const EdgeInsets.all(5),
                  decoration: BoxDecoration(
                    color: const Color.fromARGB(255, 236, 243, 234),
                    borderRadius: BorderRadius.circular(10),
                  ),
                  child: const Center(
                    child: Column(
                      mainAxisAlignment: MainAxisAlignment.center,
                      crossAxisAlignment: CrossAxisAlignment.center,
                      children: [
                        Center(
                          child: Icon(
                            Icons.check_circle_outline,
                            color: Colors.black,
                            size: 30,
                          ),
                        ),
                        SizedBox(height: 5),
                        Center(
                          child: Text(
                            "Selesai",
                            style: TextStyle(
                              color: Colors.grey,
                              fontSize: 13,
                            ),
                            textAlign: TextAlign.center,
                          ),
                        ),
                      ],
                    ),
                  ),
                ),
              ],
            ),
          ),
          Container(
            margin: const EdgeInsets.all(10),
            color: Colors.white30,
            child: const Text(
                "Telah terkonfirmasi oleh Admin, Silakan untuk melakukan upload/foto bukti transaksi yang diberikan oleh kasir pengepul/penjemput sampah kamu"),
          ),
          Container(
              margin: const EdgeInsets.all(10),
              child: Card(
                child: Padding(
                  padding: const EdgeInsets.all(8.0),
                  child: Column(
                    children: [
                      Container(
                        margin: const EdgeInsets.all(15),
                        padding: const EdgeInsets.all(5),
                        decoration: BoxDecoration(
                            borderRadius: BorderRadius.circular(10),
                            color: const Color.fromARGB(255, 227, 230, 227)),
                        child: Column(
                          mainAxisSize: MainAxisSize.min,
                          children: [
                            const SizedBox(height: 5),
                            UserImagePicker(imagePickFn: pickedImage),
                          ],
                        ),
                      ),
                      ElevatedButton.icon(
                        onPressed: isLoading ? null : _onSubmit,
                        style: ElevatedButton.styleFrom(
                            padding: const EdgeInsets.all(16.0)),
                        icon: isLoading
                            ? Container(
                                width: 24,
                                height: 24,
                                padding: const EdgeInsets.all(2.0),
                                child: const CircularProgressIndicator(
                                  color: Colors.white,
                                  strokeWidth: 3,
                                ),
                              )
                            : const Icon(Icons.upload_file),
                        label: const Text('Kirim Bukti Transaksi'),
                      ),
                    ],
                  ),
                ),
              )),
          ElevatedButton(
              onPressed: () {
                showDialog(
                    context: context,
                    builder: (BuildContext ctx) {
                      return AlertDialog(
                        title: const Text('Confirm'),
                        content: const Text('Apakah akan membatallan pesanan?'),
                        actions: [
                          // The "Yes" button
                          TextButton(
                              onPressed: () {
                                TransactionDio()
                                    .canceltransaction(widget.transaction.id!);
                                Navigator.push(context,
                                    MaterialPageRoute(builder: (context) {
                                  return const TransactionCustomerPage();
                                }));
                              },
                              child: const Text('Ya')),
                          TextButton(
                              onPressed: () {
                                // Close the dialog
                                Navigator.of(context).pop();
                              },
                              child: const Text('Tidak'))
                        ],
                      );
                    });
              },
              child: const Text("Batalkan Pesanan")),
        ],
      ),
    ));
  }
}
