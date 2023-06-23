// ignore_for_file: public_member_api_docs, sort_constructors_first

import 'dart:io';
import 'package:dio/dio.dart';
import 'package:flutter/material.dart';
import 'package:google_map/pages/success_page.dart';
import 'package:intl/intl.dart';
import 'package:google_map/services/transaction_dio.dart';
import '../../models/itemcart.dart';
import '../../models/transaction.dart';
import '../../services/cart_dio.dart';
import '../../widgets/itemcart_widget.dart';

class CheckoutDropPage extends StatefulWidget {
  const CheckoutDropPage({
    Key? key,
    required this.transaction,
    required this.filegambar,
  }) : super(key: key);

  final Transaction transaction;
  final File filegambar;

  @override
  State<CheckoutDropPage> createState() => _CheckoutDropPageState();
}

class _CheckoutDropPageState extends State<CheckoutDropPage> {
  bool isLoading = false;
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

  void _submitTrans() async {
    Transaction item = Transaction(
      customerid: widget.transaction.customerid,
      address: widget.transaction.address,
      nohp: widget.transaction.nohp,
      type: widget.transaction.type,
      weight: widget.transaction.weight,
      dropzoneid: widget.transaction.dropzoneid,
      status: "pending",
      datepickup: widget.transaction.datepickup,
      time: widget.transaction.time,
      catatan: widget.transaction.catatan,
      paymentmethod: payment,
      photo: namafilegambar,
    );

    await TransactionDio().postData(item);
    _kosongkancart();
  }

  void _kosongkancart() {
    Dio dio = Dio();
    setState(() {
      isLoading = true;
    });
    dio.post(
        "http://salin.sikocloudtech.or.id/api/kosongkancart?userid=${widget.transaction.customerid}");
  }

  void _onSubmit() {
    setState(() => isLoading = true);
    _upload(widget.filegambar);
    //_submitTrans();
    Future.delayed(
        const Duration(seconds: 3)
        // ignore: avoid_types_on_closure_parameters
        , () {
      setState(() => isLoading = false);
      Navigator.pushAndRemoveUntil(
        context,
        MaterialPageRoute(
          builder: (BuildContext context) =>
              SuccessPage(userid: widget.transaction.customerid),
        ),
        (route) => false,
      );
    });
  }

  List<ItemCart> itemcart = [];
  List<Map<String, dynamic>> _datahargamin = [];
  List<Map<String, dynamic>> _datahargamax = [];

  final currencyFormatter = NumberFormat('#,##0', 'ID');
  String payment = "";
  double biayalayananmin = 0;
  double biayalayananmax = 0;
  double nilaipendapatanmin = 0;
  double nilaipendapatanmax = 0;

  num estimasipendapatan = 0;
  num hargamin = 0;
  num hargamax = 0;

  _hargamin() {
    num total = 0;
    _datahargamin = List.generate(
        itemcart.length,
        (index) => {
              'id': itemcart[index].id,
              'harga': itemcart[index].hargamin,
              'berat': itemcart[index].berat,
            });
    for (var i = 0; i < _datahargamin.length; i++) {
      total = _datahargamin[i]['berat'] * _datahargamin[i]['harga'] + total;
    }
    setState(() {
      hargamin = total;
    });
  }

  _hargamax() {
    num total = 0;
    _datahargamax = List.generate(
        itemcart.length,
        (index) => {
              'id': itemcart[index].id,
              'harga': itemcart[index].hargamax,
              'berat': itemcart[index].berat,
            });
    for (var i = 0; i < _datahargamax.length; i++) {
      total = _datahargamax[i]['berat'] * _datahargamax[i]['harga'] + total;
    }
    setState(() {
      hargamax = total;
    });
  }

  void refreshData() async {
    setState(() {
      isLoading = true;
    });
    CartDio().itemcart(widget.transaction.customerid).then((value) {
      setState(() {
        itemcart = value;
        isLoading = false;
        _hargamin();
        _hargamax();
        biayalayananmin = hargamin * 0.1;
        biayalayananmax = hargamax * 0.1;
        nilaipendapatanmin = hargamin - biayalayananmin;
        nilaipendapatanmax = hargamax - biayalayananmax;
      });
    });
  }

  @override
  void initState() {
    super.initState();
    refreshData();
  }

  @override
  Widget build(BuildContext context) {
    final size = MediaQuery.of(context).size;
    return Scaffold(
      appBar: AppBar(
        foregroundColor: Colors.black,
        backgroundColor: Colors.orange,
        title: const Text('Informasi Dropoff'),
      ),
      body: SingleChildScrollView(
        child: Column(
          mainAxisSize: MainAxisSize.min,
          children: [
            Card(
              margin: const EdgeInsets.all(20),
              child: Column(
                children: [
                  Container(
                    padding: const EdgeInsets.all(5),
                    color: const Color.fromARGB(255, 231, 230, 228),
                    width: size.width,
                    child: const Text(
                      'Informasi Tempat Tinggal',
                      style: TextStyle(
                        fontSize: 16,
                      ),
                      textAlign: TextAlign.center,
                    ),
                  ),
                  const SizedBox(height: 10),
                  Padding(
                    padding: const EdgeInsets.only(left: 10),
                    child: Row(
                      children: [
                        const Icon(Icons.phone),
                        const SizedBox(width: 10),
                        Text(
                          widget.transaction.nohp.toString(),
                          textAlign: TextAlign.start,
                        ),
                      ],
                    ),
                  ),
                  const SizedBox(height: 10),
                  Padding(
                    padding: const EdgeInsets.only(left: 10),
                    child: Row(
                      children: [
                        const Icon(Icons.location_on),
                        const SizedBox(width: 10),
                        Text(
                          widget.transaction.address.toString(),
                          textAlign: TextAlign.start,
                        ),
                      ],
                    ),
                  ),
                  const SizedBox(height: 10),
                  Padding(
                    padding: const EdgeInsets.only(left: 10),
                    child: Row(
                      children: [
                        const Icon(Icons.calendar_today),
                        const SizedBox(width: 10),
                        Text(
                          widget.transaction.datepickup.toString(),
                          textAlign: TextAlign.start,
                        ),
                      ],
                    ),
                  ),
                  const SizedBox(height: 10),
                  Padding(
                    padding: const EdgeInsets.only(left: 10),
                    child: Row(
                      children: [
                        const Icon(Icons.access_time),
                        const SizedBox(width: 10),
                        Text(
                          widget.transaction.time.toString(),
                          textAlign: TextAlign.start,
                        ),
                      ],
                    ),
                  ),
                  const SizedBox(height: 10),
                ],
              ),
            ),
            Card(
              margin: const EdgeInsets.only(left: 20, right: 20),
              child: Column(
                mainAxisSize: MainAxisSize.min,
                children: [
                  Container(
                    padding: const EdgeInsets.all(5),
                    color: const Color.fromARGB(255, 231, 230, 228),
                    width: size.width,
                    child: const Text(
                      'Informasi Penjualan',
                      style: TextStyle(
                        fontSize: 16,
                      ),
                      textAlign: TextAlign.center,
                    ),
                  ),
                  const SizedBox(height: 10),
                  Padding(
                    padding: const EdgeInsets.all(8.0),
                    child: itemcart.isEmpty
                        ? const Center(
                            child: Text('Tidak ada Item'),
                          )
                        : Column(
                            mainAxisSize: MainAxisSize.min,
                            mainAxisAlignment: MainAxisAlignment.start,
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              ListView.builder(
                                  shrinkWrap: true,
                                  itemCount: itemcart.length,
                                  itemBuilder: (context, index) {
                                    return ItemCartWidget(
                                      itemcart: itemcart[index],
                                      userid: widget.transaction.customerid,
                                      handleRefresh: () {
                                        refreshData();
                                      },
                                    );
                                  }),
                              const Card(
                                color: Color.fromARGB(255, 11, 129, 240),
                                child: SizedBox(
                                  width: 400,
                                  height: 100,
                                  child: Padding(
                                    padding: EdgeInsets.all(10),
                                    child: Center(
                                        child: Text(
                                            style:
                                                TextStyle(color: Colors.white),
                                            'Setiap penjualan akan dikenakan biaya layananan sebesar 10% kepada penggguna, INGIN DONASI SAMPAH HUBUNGI ADMIN SALIN +62 853-8182-8343')),
                                  ),
                                ),
                              ),
                            ],
                          ),
                  ),
                  const SizedBox(height: 10),
                  Padding(
                    padding: const EdgeInsets.only(left: 10, right: 10),
                    child: Row(
                      children: [
                        const Text('Estimasi Penjualan',
                            style: TextStyle(fontSize: 11)),
                        const SizedBox(width: 10),
                        Expanded(
                          child: Text(
                            'Rp. ${currencyFormatter.format(hargamin)} s/d Rp. ${currencyFormatter.format(hargamax)}',
                            textAlign: TextAlign.end,
                            style: const TextStyle(
                                fontWeight: FontWeight.bold,
                                fontSize: 11,
                                color: Color.fromARGB(255, 5, 5, 5)),
                          ),
                        ),
                      ],
                    ),
                  ),
                  Padding(
                    padding: const EdgeInsets.only(left: 10, right: 10),
                    child: Row(
                      children: [
                        const Text('Biaya Layanan',
                            style: TextStyle(fontSize: 11)),
                        const SizedBox(width: 10),
                        Expanded(
                          child: Text(
                            'Rp. ${currencyFormatter.format(biayalayananmin)} s/d Rp. ${currencyFormatter.format(biayalayananmax)}',
                            textAlign: TextAlign.end,
                            style: const TextStyle(
                                fontWeight: FontWeight.bold,
                                fontSize: 11,
                                color: Color.fromARGB(255, 247, 76, 9)),
                          ),
                        ),
                      ],
                    ),
                  ),
                  Padding(
                    padding: const EdgeInsets.only(left: 10, right: 10),
                    child: Row(
                      children: [
                        const Text('Nilai Pendapatan',
                            style: TextStyle(fontSize: 11)),
                        const SizedBox(width: 10),
                        Expanded(
                          child: Text(
                            'Rp. ${currencyFormatter.format(nilaipendapatanmin)} s/d Rp. ${currencyFormatter.format(nilaipendapatanmax)}',
                            textAlign: TextAlign.end,
                            style: const TextStyle(
                                fontWeight: FontWeight.bold,
                                fontSize: 11,
                                color: Color(
                                  0xFF11B719,
                                )),
                          ),
                        ),
                      ],
                    ),
                  ),
                  const SizedBox(height: 10),
                ],
              ),
            ),
            const SizedBox(height: 10),
            Container(
              margin: const EdgeInsets.only(left: 20, right: 20, bottom: 20),
              child: Row(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                children: [
                  Container(
                    padding: const EdgeInsets.all(10),
                    decoration: BoxDecoration(
                      color: const Color.fromARGB(255, 51, 238, 14),
                      borderRadius: BorderRadius.circular(10),
                      border: Border.all(
                        color: Colors.black,
                        width: 2,
                      ),
                    ),
                    width: size.width * 0.4,
                    child: Column(
                      children: [
                        const Center(
                            child: Text(
                          'Pembayaran Point (1 point = Rp. 50)',
                          style: TextStyle(fontSize: 12),
                          textAlign: TextAlign.center,
                        )),
                        Radio(
                            value: "point",
                            groupValue: payment,
                            onChanged: (value) {
                              setState(() {
                                payment = value.toString();
                              });
                            })
                      ],
                    ),
                  ),
                  const SizedBox(width: 10),
                  Container(
                    padding: const EdgeInsets.all(10),
                    decoration: BoxDecoration(
                      color: const Color.fromARGB(255, 51, 238, 14),
                      borderRadius: BorderRadius.circular(10),
                      border: Border.all(
                        color: Colors.black,
                        width: 2,
                      ),
                    ),
                    width: size.width * 0.4,
                    child: Column(
                      children: [
                        const Text(
                          'Pembayaran Rupiah',
                          textAlign: TextAlign.center,
                        ),
                        Radio(
                            value: "cash",
                            groupValue: payment,
                            onChanged: (value) {
                              setState(() {
                                payment = value.toString();
                              });
                            })
                      ],
                    ),
                  ),
                ],
              ),
            ),
            ElevatedButton.icon(
              onPressed: isLoading ? null : _onSubmit,
              style:
                  ElevatedButton.styleFrom(padding: const EdgeInsets.all(16.0)),
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
                  : const Icon(Icons.feedback),
              label: const Text('Proses Penjemputan'),
            ),
          ],
        ),
      ),
    );
  }
}
