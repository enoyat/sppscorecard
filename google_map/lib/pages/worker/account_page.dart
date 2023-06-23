import "package:carousel_slider/carousel_slider.dart";
import "package:flutter/material.dart";
import "package:google_map/models/useraccount.dart";
import "package:google_map/pages/worker/dashboard_page.dart";
import "package:google_map/services/network_manager.dart";
import "package:shared_preferences/shared_preferences.dart";

import "../login.dart";

class AccountPageWorker extends StatefulWidget {
  const AccountPageWorker({super.key});

  @override
  State<AccountPageWorker> createState() => _AccountPageWorkerState();
}

class _AccountPageWorkerState extends State<AccountPageWorker> {
  int selectedindex = 0;
  String? username = "";
  int? userid;
  bool isLoading = false;
  List<UserAccount> useraccount = [];

  final CarouselController carouselController = CarouselController();
  void _ontap(int index) {
    if (index == 0) {
      Navigator.push(context, MaterialPageRoute(builder: (context) {
        return DashboardPageWorker(userid: userid!);
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

  setter() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    setState(() {
      username = prefs.getString('username');
      userid = prefs.getInt('userid');
    });
  }

  void refreshData() async {
    await NetworkManager().getaccountworker(userid!).then((value) {
      setState(() {
        useraccount = value;
        isLoading = false;
      });
    });
  }

  @override
  void initState() {
    super.initState();
    setter().then((value) {
      refreshData();
    });

//
  }

  @override
  Widget build(BuildContext context) {
    return WillPopScope(
      onWillPop: () async => false,
      child: Scaffold(
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
                  "Account",
                  textAlign: TextAlign.center,
                  style: TextStyle(
                    fontSize: 20,
                    fontWeight: FontWeight.bold,
                  ),
                ),
              ),
              Container(
                height: 70,
                width: double.infinity,
                color: Colors.transparent,
                margin: const EdgeInsets.only(top: 10),
                child: Image.asset('assets/images/logo.png',
                    width: 100, height: 100),
              ),
              const SizedBox(
                height: 10,
              ),
              isLoading
                  ? const Center(
                      child: CircularProgressIndicator(),
                    )
                  : useraccount.isEmpty
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
                                        useraccount[0].name,
                                        style: const TextStyle(
                                            fontSize: 13,
                                            fontWeight: FontWeight.bold),
                                      ),
                                    ],
                                  ),
                                  Row(
                                    children: [
                                      const Icon(Icons.email),
                                      const SizedBox(
                                        width: 10,
                                      ),
                                      Text(
                                        useraccount[0].email,
                                        style: const TextStyle(
                                            fontSize: 13,
                                            fontWeight: FontWeight.bold),
                                      ),
                                    ],
                                  ),
                                  Row(
                                    children: [
                                      const Icon(Icons.add_location),
                                      const SizedBox(
                                        width: 10,
                                      ),
                                      Text(
                                        useraccount[0].address,
                                        style: const TextStyle(
                                            fontSize: 13,
                                            fontWeight: FontWeight.bold),
                                      ),
                                    ],
                                  ),
                                  Row(
                                    children: [
                                      const Icon(Icons.person_2_sharp),
                                      const SizedBox(
                                        width: 10,
                                      ),
                                      Text(
                                        useraccount[0].gender,
                                        style: const TextStyle(
                                            fontSize: 13,
                                            fontWeight: FontWeight.bold),
                                      ),
                                    ],
                                  ),
                                  Row(
                                    children: [
                                      const Icon(Icons.calendar_month),
                                      const SizedBox(
                                        width: 10,
                                      ),
                                      Text(
                                        useraccount[0].birthday!,
                                        style: const TextStyle(
                                            fontSize: 13,
                                            fontWeight: FontWeight.bold),
                                      ),
                                    ],
                                  ),
                                ],
                              ),
                            ),
                          ),
                        ),
              Row(
                children: [
                  Expanded(
                    child: Padding(
                      padding: const EdgeInsets.all(6.0),
                      child: ElevatedButton(
                        onPressed: () async {
                          SharedPreferences preferences =
                              await SharedPreferences.getInstance();
                          await preferences.clear();
                          if (!mounted) return;
                          Navigator.pushReplacement(context,
                              MaterialPageRoute(builder: (context) {
                            return const LoginPage();
                          }));
                        },
                        child: const Text("Logout"),
                      ),
                    ),
                  ),
                ],
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
      ),
    );
  }
}
