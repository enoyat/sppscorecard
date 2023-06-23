import "package:carousel_slider/carousel_slider.dart";
import "package:flutter/material.dart";
import "package:google_map/models/transaction.dart";
import "package:google_map/pages/worker/dashboard_page.dart";
import "package:google_map/services/transaction_dio.dart";
import "package:google_map/shared/shared_bio.dart";

import "../../widgets/transactionworker_widget.dart";
import "account_page.dart";

class TransactionWorkerPage extends StatefulWidget {
  const TransactionWorkerPage({super.key});

  @override
  State<TransactionWorkerPage> createState() => _TransactionWorkerPageState();
}

class _TransactionWorkerPageState extends State<TransactionWorkerPage> {
  int selectedindex = 0;
  String? nama = "";
  int? userid;
  bool isLoading = false;
  List<Transaction> _transaction = [];

  final CarouselController carouselController = CarouselController();
  void _ontap(int index) {
    if (index == 0) {
      Navigator.push(context, MaterialPageRoute(builder: (context) {
        return DashboardPageWorker(
          userid: userid!,
        );
      }));
    } else if (index == 1) {
      Navigator.push(context, MaterialPageRoute(builder: (context) {
        return const AccountPageWorker();
      }));
    }
    setState(() {
      selectedindex = index;
    });
  }

  void refreshData() async {
    setState(() {
      isLoading = true;
    });
    await SharedBio.readPrefStr("nama").then((value) {
      setState(() {
        nama = value;
      });
    });
    await SharedBio.readPrefInt("userid").then((value) {
      setState(() {
        userid = value;
      });
    });
    await TransactionDio()
        .listtransactionworker(userid!, 'pending')
        .then((value) {
      setState(() {
        _transaction = value;
        isLoading = false;
      });
    });
  }

  @override
  void initState() {
    super.initState();

    refreshData();
//
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Padding(
        padding: const EdgeInsets.all(8.0),
        child: Column(
          children: [
            const SizedBox(
              height: 30,
            ),
            Container(
              alignment: Alignment.center,
              height: 50,
              color: Colors.orange,
              width: double.infinity,
              child: const Text(
                "Order",
                textAlign: TextAlign.center,
                style: TextStyle(
                  fontSize: 20,
                  fontWeight: FontWeight.bold,
                ),
              ),
            ),
            Container(
              height: 70,
              color: Colors.transparent,
              margin: const EdgeInsets.only(top: 10),
              child: Image.asset('assets/images/logo.png',
                  width: 100, height: 100),
            ),
            isLoading
                ? const Center(
                    child: CircularProgressIndicator(),
                  )
                : Expanded(
                    child: _transaction.isEmpty
                        ? const Center(
                            child: Text('Tidak ada Transaksi'),
                          )
                        : ListView.builder(
                            itemCount: _transaction.length,
                            itemBuilder: (context, index) {
                              return TransactionWorkerWidget(
                                transaction: _transaction[index],
                                handleRefresh: refreshData,
                              );
                            }),
                  ),
          ],
        ),
      ),
      bottomNavigationBar: BottomNavigationBar(
        type: BottomNavigationBarType.fixed,
        selectedItemColor: const Color.fromARGB(255, 4, 163, 226),
        iconSize: 20,
        currentIndex: selectedindex,
        onTap: _ontap,
        items: const [
          BottomNavigationBarItem(
            icon: Icon(Icons.home),
            label: 'Home',
          ),
          BottomNavigationBarItem(
            icon: Icon(Icons.person),
            label: 'Account',
          ),
        ],
      ),
    );
  }
}
