// ignore_for_file: public_member_api_docs, sort_constructors_first
import 'package:flutter/material.dart';
import 'package:google_map/models/transaction.dart';
import '../pages/customer/transaction_page.dart';

class OrderStatusDone extends StatelessWidget {
  const OrderStatusDone({
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
                            color: Color.fromARGB(255, 107, 216, 5),
                            size: 30,
                          ),
                        ),
                        SizedBox(height: 5),
                        Center(
                          child: Text(
                            "Selesai",
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
              ],
            ),
          ),
          Container(
            margin: const EdgeInsets.all(10),
            color: Colors.white30,
            child: const Text(
                "Terima Kasih. Verifikasi dari admin telah selesai, untuk proses mendapatkan Point/Penukaran Tunai, Kamu akan dihubungi oleh Nomor WA Resmi Admin di : 08xxxx"),
          ),
          ElevatedButton(
              onPressed: () {
                Navigator.push(context, MaterialPageRoute(builder: (context) {
                  return const TransactionCustomerPage();
                }));
              },
              child: const Text("Selesai")),
        ],
      ),
    ));
  }
}
