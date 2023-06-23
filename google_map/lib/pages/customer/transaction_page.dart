import "package:carousel_slider/carousel_slider.dart";
import "package:flutter/material.dart";
import "package:google_map/models/transaction.dart";
import "package:google_map/pages/account_page.dart";
import "package:google_map/pages/chat_screen.dart";
import "package:google_map/pages/dashboard_page.dart";
import "package:google_map/services/transaction_dio.dart";
import "package:google_map/shared/shared_bio.dart";
import "package:google_map/widgets/transaction_widget.dart";

class TransactionCustomerPage extends StatefulWidget {
  const TransactionCustomerPage({super.key});

  @override
  State<TransactionCustomerPage> createState() => _DashboardPageState();
}

class _DashboardPageState extends State<TransactionCustomerPage> {
  int selectedindex = 0;
  String? nama = "";
  int? userid;
  bool isLoading = false;
  List<Transaction> _transaction = [];

  final CarouselController carouselController = CarouselController();
  void _ontap(int index) {
    if (index == 0) {
      Navigator.push(context, MaterialPageRoute(builder: (context) {
        return DashboardPage(
          userid: userid!,
        );
      }));
    } else if (index == 1) {
      Navigator.push(context, MaterialPageRoute(builder: (context) {
        return ChatPage(
          userid: userid!,
        );
      }));
    } else if (index == 2) {
      Navigator.push(context, MaterialPageRoute(builder: (context) {
        return const TransactionCustomerPage();
      }));
    } else if (index == 3) {
      Navigator.push(context, MaterialPageRoute(builder: (context) {
        return const AccountPage();
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
    await TransactionDio().listtransaction(userid!, 'pending').then((value) {
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
                              return TransactionWidget(
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
            icon: Icon(Icons.message),
            label: 'Message',
          ),
          BottomNavigationBarItem(
            icon: Icon(Icons.list_alt_outlined),
            label: 'CekOrder',
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
