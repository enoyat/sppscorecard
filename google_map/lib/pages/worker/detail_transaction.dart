// ignore_for_file: public_member_api_docs, sort_constructors_first
import 'package:flutter/material.dart';
import 'package:url_launcher/url_launcher.dart';
import 'package:url_launcher/url_launcher_string.dart';
import '../../models/transaction.dart';
import '../../services/transaction_dio.dart';

class DetailTransactionWorker extends StatefulWidget {
  const DetailTransactionWorker({
    Key? key,
    this.id,
  }) : super(key: key);
  final int? id;

  @override
  State<DetailTransactionWorker> createState() =>
      _DetailTransactionWorkerState();
}

class _DetailTransactionWorkerState extends State<DetailTransactionWorker> {
  List<Transaction> _transaction = [];
  bool isLoading = false;
  String isProses = '';

  void refresh() async {
    setState(() {
      isLoading = true;
    });
    await TransactionDio().gettransaction(widget.id!).then((value) {
      setState(() {
        _transaction = value;
        isProses = _transaction[0].status.toString();
        isLoading = false;
      });
    });
  }

  @override
  void initState() {
    super.initState();
    if (widget.id != null) {
      refresh();
    }
  }

  static void navigateTo(double lat, double lng) async {
    var uri = Uri.parse("google.navigation:q=$lat,$lng&mode=d");
    if (await canLaunchUrl(uri)) {
      await launchUrl(uri);
    } else {
      throw 'Could not launch ${uri.toString()}';
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
        appBar: AppBar(
          title: const Text("Detail Transaction Worker"),
        ),
        body: Container(
          child: isLoading
              ? const Center(
                  child: CircularProgressIndicator(),
                )
              : _transaction.isEmpty
                  ? const Center(
                      child: Text('Tidak ada Transaksi'),
                    )
                  : Container(
                      padding: const EdgeInsets.all(5),
                      width: double.infinity,
                      child: Card(
                        shape: RoundedRectangleBorder(
                            borderRadius: BorderRadius.circular(10)),
                        elevation: 5,
                        color: Colors.amber,
                        child: Padding(
                          padding: const EdgeInsets.all(8.0),
                          child: Column(
                            mainAxisSize: MainAxisSize.min,
                            children: [
                              Row(
                                children: [
                                  const Icon(Icons.person),
                                  const SizedBox(
                                    width: 10,
                                  ),
                                  Text(
                                    _transaction[0].name.toString(),
                                    style: const TextStyle(
                                        fontSize: 13,
                                        fontWeight: FontWeight.bold),
                                  ),
                                ],
                              ),
                              Row(
                                children: [
                                  TextButton.icon(
                                      onPressed: () {
                                        launchUrlString(
                                            "tel://${_transaction[0].nohp}");
                                      },
                                      icon: const Icon(Icons.phone),
                                      label: Text(
                                          _transaction[0].nohp.toString())),
                                ],
                              ),
                              Row(
                                children: [
                                  const Icon(Icons.add_location),
                                  const SizedBox(
                                    width: 10,
                                  ),
                                  Text(
                                    _transaction[0].address.toString(),
                                    style: const TextStyle(
                                        fontSize: 13,
                                        fontWeight: FontWeight.bold),
                                  ),
                                ],
                              ),
                              Row(
                                children: [
                                  const Icon(Icons.check_box),
                                  const SizedBox(
                                    width: 10,
                                  ),
                                  Text(
                                    _transaction[0].status.toString(),
                                    style: const TextStyle(
                                        fontSize: 13,
                                        fontWeight: FontWeight.bold),
                                  ),
                                ],
                              ),
                              Row(
                                children: [
                                  const Icon(Icons.wallet_travel),
                                  const SizedBox(
                                    width: 10,
                                  ),
                                  Text(
                                    _transaction[0].weight.toString(),
                                    style: const TextStyle(
                                        fontSize: 13,
                                        fontWeight: FontWeight.bold),
                                  ),
                                ],
                              ),
                              Row(
                                children: [
                                  const Icon(Icons.add_location_rounded),
                                  const SizedBox(
                                    width: 10,
                                  ),
                                  Text(
                                    "lat: ${_transaction[0].latitude}, long: ${_transaction[0].longitude}",
                                    style: const TextStyle(
                                        fontSize: 13,
                                        fontWeight: FontWeight.bold),
                                  ),
                                ],
                              ),
                              Row(
                                children: [
                                  Expanded(
                                    child: Padding(
                                      padding: const EdgeInsets.all(6.0),
                                      child: ElevatedButton(
                                        onPressed: () {
                                          navigateTo(_transaction[0].latitude!,
                                              _transaction[0].longitude!);
                                          // Android
                                        },
                                        child: const Text("Map"),
                                      ),
                                    ),
                                  ),
                                ],
                              ),
                            ],
                          ),
                        ),
                      ),
                    ),
        ));
  }
}
