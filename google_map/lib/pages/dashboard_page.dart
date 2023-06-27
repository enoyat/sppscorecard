// ignore_for_file: public_member_api_docs, sort_constructors_first

import "package:carousel_slider/carousel_slider.dart";
import "package:flutter/material.dart";
import "package:google_map/pages/mekanik/listoftrouble_page.dart";
import "package:intl/intl.dart";
import "package:shared_preferences/shared_preferences.dart";

import "login.dart";

class DashboardPage extends StatefulWidget {
  const DashboardPage({
    Key? key,
    required this.userid,
  }) : super(key: key);
  final int userid;

  @override
  State<DashboardPage> createState() => _DashboardPageState();
}

class _DashboardPageState extends State<DashboardPage> {
  late SharedPreferences prefs;
  Future<void> loadPrefs() async {
    prefs = await SharedPreferences.getInstance();
  }

  var f = NumberFormat("#,###", "id_ID");
  int selectedindex = 0;
  int pageIndex = 0;
  int pageIndexadds = 0;
  String? username = "";
  int? userid;
  bool isAds = false;
  bool isNews = false;

  bool isLoading = false;
  int addsCount = 1;
  int newsCount = 1;

  void refreshData() async {
    setState(() {
      isLoading = true;
    });
  }

  setter() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    setState(() {
      username = prefs.getString('username');
      userid = prefs.getInt('userid');
    });
  }

  @override
  void initState() {
    super.initState();
    setter().then((value) {
      loadPrefs().then((value) {
        refreshData();
      });
    });
  }

  void _logout() async {
    SharedPreferences preferences = await SharedPreferences.getInstance();
    await preferences.clear();
    if (!mounted) return;
    Navigator.pushReplacement(context, MaterialPageRoute(builder: (context) {
      return const LoginPage();
    }));
  }

  final CarouselController carouselController = CarouselController();
  void _ontap(int index) {
    if (index == 0) {
      Navigator.push(context, MaterialPageRoute(builder: (context) {
        return DashboardPage(userid: widget.userid);
      }));
    } else if (index == 1) {
      _logout();
    }
    setState(() {
      selectedindex = index;
    });
  }

  @override
  Widget build(BuildContext context) {
    final size = MediaQuery.of(context).size;
    return WillPopScope(
      onWillPop: () async => false,
      child: Container(
        decoration: const BoxDecoration(
          image: DecorationImage(
            image: AssetImage("assets/images/background.png"),
            fit: BoxFit.cover,
          ),
        ),
        child: Scaffold(
          backgroundColor: Colors.transparent,
          body: SingleChildScrollView(
            child: Padding(
              padding: const EdgeInsets.all(8.0),
              child: Column(
                children: [
                  Column(
                    crossAxisAlignment: CrossAxisAlignment.center,
                    children: [
                      Column(
                        children: [
                          Container(
                            margin: const EdgeInsets.only(top: 20),
                            height: 140,
                            width: 220,
                            child: Column(
                              children: [
                                const SizedBox(height: 10),
                                CircleAvatar(
                                  backgroundColor: Colors.white,
                                  radius: 50,
                                  child: Image.asset('assets/images/logo.png',
                                      width: 100, height: 100),
                                ),
                                const SizedBox(height: 15),
                                Text('${widget.userid} - $username',
                                    style: const TextStyle(
                                      fontSize: 13,
                                      fontWeight: FontWeight.bold,
                                    )),
                              ],
                            ),
                          ),
                          Container(
                            margin: const EdgeInsets.only(top: 5),
                            height: 80,
                            width: 280,
                            child: Card(
                              margin: const EdgeInsets.only(top: 5, bottom: 5),
                              color: Color.fromARGB(255, 245, 224, 250),
                              elevation: 5,
                              shape: RoundedRectangleBorder(
                                borderRadius: BorderRadius.circular(10),
                              ),
                              child: Column(
                                crossAxisAlignment: CrossAxisAlignment.start,
                                children: [
                                  const SizedBox(height: 10),
                                  Padding(
                                    padding: const EdgeInsets.only(left: 8.0),
                                    child: Text('CBU : $username',
                                        textAlign: TextAlign.left,
                                        style: const TextStyle(
                                          fontSize: 12,
                                          fontWeight: FontWeight.bold,
                                        )),
                                  ),
                                  const SizedBox(height: 5),
                                  Padding(
                                    padding: const EdgeInsets.only(left: 8.0),
                                    child: Text('Region : $username',
                                        style: const TextStyle(
                                          fontSize: 12,
                                          fontWeight: FontWeight.bold,
                                        )),
                                  ),
                                  const SizedBox(height: 5),
                                  Padding(
                                    padding: const EdgeInsets.only(left: 8.0),
                                    child: Text('Site Name : $username',
                                        style: const TextStyle(
                                          fontSize: 12,
                                          fontWeight: FontWeight.bold,
                                        )),
                                  )
                                ],
                              ),
                            ),
                          ),
                        ],
                      ),
                      GridView.count(
                          crossAxisCount: 2,
                          shrinkWrap: true,
                          children: [
                            Card(
                              color: const Color.fromARGB(255, 245, 244, 206),
                              elevation: 5,
                              shape: RoundedRectangleBorder(
                                borderRadius: BorderRadius.circular(10),
                              ),
                              child: InkWell(
                                onTap: () {
                                  Navigator.push(context,
                                      MaterialPageRoute(builder: (context) {
                                    return const ListOfTroublePage();
                                  }));
                                },
                                child: Column(
                                  mainAxisAlignment: MainAxisAlignment.center,
                                  children: [
                                    Image.asset(
                                      'assets/images/trouble.png',
                                      width: 70,
                                      height: 70,
                                    ),
                                    const SizedBox(height: 10),
                                    const Text(
                                      'Trouble',
                                      style: TextStyle(
                                        fontSize: 15,
                                        fontWeight: FontWeight.bold,
                                      ),
                                    ),
                                  ],
                                ),
                              ),
                            ),
                            Card(
                              color: const Color.fromARGB(255, 204, 211, 245),
                              elevation: 5,
                              shape: RoundedRectangleBorder(
                                borderRadius: BorderRadius.circular(10),
                              ),
                              child: InkWell(
                                onTap: () {},
                                child: Column(
                                  mainAxisAlignment: MainAxisAlignment.center,
                                  children: [
                                    Image.asset(
                                      'assets/images/maintenance.png',
                                      width: 70,
                                      height: 70,
                                    ),
                                    const SizedBox(height: 10),
                                    const Text(
                                      'Maintenance',
                                      style: TextStyle(
                                        fontSize: 15,
                                        fontWeight: FontWeight.bold,
                                      ),
                                    ),
                                  ],
                                ),
                              ),
                            ),
                          ])
                    ],
                  ),
                  const SizedBox(
                    height: 50,
                  )
                ],
              ),
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
                icon: Icon(Icons.logout_outlined),
                label: 'Logout',
              ),
            ],
          ),
        ),
      ),
    );
  }
}
