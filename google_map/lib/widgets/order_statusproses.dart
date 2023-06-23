// ignore_for_file: public_member_api_docs, sort_constructors_first
import 'package:flutter/material.dart';
import 'package:google_map/models/transaction.dart';

import '../pages/customer/transaction_page.dart';
import '../services/transaction_dio.dart';

class OrderStatusProses extends StatelessWidget {
  const OrderStatusProses({
    Key? key,
    required this.transaction,
  }) : super(key: key);

  final Transaction transaction;
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
                            color: Colors.black,
                            size: 30,
                          ),
                        ),
                        SizedBox(height: 5),
                        Center(
                          child: Text(
                            "Terkonfirmasi Admin",
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
                            Icons.archive,
                            color: Color.fromARGB(255, 107, 216, 5),
                            size: 30,
                          ),
                        ),
                        SizedBox(height: 5),
                        Center(
                          child: Text(
                            "Telah Diterima",
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
                "Terima Kasih, Bukti transaksi telah Kamu terima, untuk proses selanjutnya silakan menunggu proses dari Admin 1x24 jam"),
          ),
          Container(
              margin: const EdgeInsets.all(10),
              child: const Text('Butuh bantuan? Hubungi Admin di WA:082xxx',
                  style: TextStyle(fontSize: 16))),
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
                                    .canceltransaction(transaction.id!);
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
