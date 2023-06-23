// ignore_for_file: public_member_api_docs, sort_constructors_first
import "package:carousel_indicator/carousel_indicator.dart";
import "package:carousel_slider/carousel_slider.dart";
import "package:flutter/material.dart";
import "package:google_map/pages/worker/transaction_page.dart";
import "package:intl/intl.dart";
import "package:shared_preferences/shared_preferences.dart";

import "package:google_map/models/addsmodel.dart";
import "package:google_map/services/adds_dio.dart";
import "package:google_map/services/network_manager.dart";

import "../../models/newsmodel.dart";
import "../../services/news_dio.dart";
import "account_page.dart";

class DashboardPageWorker extends StatefulWidget {
  const DashboardPageWorker({
    Key? key,
    required this.userid,
  }) : super(key: key);
  final int userid;

  @override
  State<DashboardPageWorker> createState() => _DashboardPageWorkerState();
}

class _DashboardPageWorkerState extends State<DashboardPageWorker> {
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
  List<AddsModel> _addsmodel = [];
  List<NewsModel> _newsmodel = [];

  String urlasset = "http://salin.sikocloudtech.or.id/assets/inventory";

  void refreshData() async {
    setState(() {
      isLoading = true;
    });
    AddsDio().getData().then((value) {
      setState(() {
        _addsmodel = value;
        if (_addsmodel.isNotEmpty) {
          isAds = true;
        }
        addsCount = value.length;
      });
    });
    NewsDio().getData().then((value) {
      setState(() {
        _newsmodel = value;
        if (_newsmodel.isNotEmpty) {
          isNews = true;
        }
        newsCount = value.length;
        isLoading = false;
      });
    });
  }

  void saldo() async {
    setState(() {
      isLoading = true;
    });
    await NetworkManager().getdeposit(widget.userid).then((value) {
      setState(() {
        isLoading = false;
      });
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
        saldo();
      });
    });
  }

  final CarouselController carouselController = CarouselController();
  void _ontap(int index) {
    if (index == 0) {
      Navigator.push(context, MaterialPageRoute(builder: (context) {
        return DashboardPageWorker(userid: widget.userid);
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

  @override
  Widget build(BuildContext context) {
    final size = MediaQuery.of(context).size;
    return WillPopScope(
      onWillPop: () async => false,
      child: Scaffold(
        body: SingleChildScrollView(
          child: Container(
            decoration: const BoxDecoration(
              image: DecorationImage(
                  image: AssetImage("assets/images/background.png"),
                  fit: BoxFit.cover),
            ),
            padding: const EdgeInsets.all(10),
            child: Column(
              children: [
                Column(
                  crossAxisAlignment: CrossAxisAlignment.center,
                  children: [
                    Container(
                      height: 70,
                      color: Colors.transparent,
                      margin: const EdgeInsets.only(top: 10),
                      child: Image.asset('assets/images/logo.png',
                          width: 100, height: 100),
                    ),
                    Container(
                      margin: const EdgeInsets.only(top: 5),
                      height: 80,
                      width: double.infinity,
                      child: Card(
                        margin: const EdgeInsets.only(top: 5, bottom: 5),
                        color: const Color.fromARGB(255, 240, 240, 241),
                        elevation: 5,
                        shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(10),
                        ),
                        child: Column(
                          children: [
                            const SizedBox(height: 10),
                            Text('$username ',
                                style: const TextStyle(
                                  fontSize: 20,
                                  fontWeight: FontWeight.bold,
                                )),
                            const SizedBox(height: 5),
                            const Text('Selamat Datang Sahabat Hijau',
                                style: TextStyle(fontSize: 15)),
                          ],
                        ),
                      ),
                    ),
                    Card(
                      margin: const EdgeInsets.only(top: 1, bottom: 1),
                      color: const Color.fromARGB(255, 58, 127, 231),
                      elevation: 5,
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(10),
                      ),
                      child: Column(
                        mainAxisSize: MainAxisSize.min,
                        children: [
                          ListTile(
                            dense: true,
                            visualDensity: const VisualDensity(vertical: -3),
                            leading: const Icon(Icons.directions_car, size: 40),
                            title: const Text('Pick Up',
                                style: TextStyle(
                                    fontSize: 15, fontWeight: FontWeight.bold)),
                            subtitle: const Text('Penjemputan Sampah',
                                style: TextStyle(fontSize: 13)),
                            trailing: TextButton(
                              style: TextButton.styleFrom(
                                backgroundColor:
                                    const Color.fromARGB(255, 248, 146, 13),
                                shape: RoundedRectangleBorder(
                                  borderRadius: BorderRadius.circular(10),
                                ),
                              ),
                              onPressed: () {
                                Navigator.push(context,
                                    MaterialPageRoute(builder: (context) {
                                  return const TransactionWorkerPage();
                                }));
                              },
                              child: const Text('Pilih',
                                  style: TextStyle(
                                      fontSize: 15,
                                      fontWeight: FontWeight.bold,
                                      color: Colors.white)),
                            ),
                          ),
                        ],
                      ),
                    ),
                    isNews
                        ? Column(
                            children: [
                              Container(
                                margin:
                                    const EdgeInsets.only(top: 5, bottom: 5),
                                width: size.width * 0.95,
                                decoration: ShapeDecoration(
                                  color:
                                      const Color.fromARGB(255, 211, 247, 198),
                                  shape: RoundedRectangleBorder(
                                    borderRadius: BorderRadius.circular(10),
                                  ),
                                ),
                                child: CarouselSlider(
                                  carouselController: carouselController,
                                  options: CarouselOptions(
                                    viewportFraction: 1,
                                    enlargeCenterPage: false,
                                    autoPlay: true,
                                    autoPlayInterval:
                                        const Duration(seconds: 4),
                                    autoPlayAnimationDuration:
                                        const Duration(milliseconds: 500),
                                    height: 280,
                                    onPageChanged: (index, reason) {
                                      setState(() {
                                        pageIndex = index;
                                      });
                                    },
                                  ),
                                  items: _newsmodel.map((item) {
                                    return GridTile(
                                      child: Image.network(
                                          '$urlasset/${item.image}',
                                          fit: BoxFit.fill),
                                    );
                                  }).toList(),
                                ),
                              ),
                              CarouselIndicator(
                                count: newsCount,
                                index: pageIndex,
                                color: Colors.blue,
                                activeColor: Colors.red,
                              ),
                            ],
                          )
                        : const Text('tidak ada news'),
                    const SizedBox(
                      height: 5,
                    ),
                    isAds
                        ? Column(
                            children: [
                              Container(
                                margin:
                                    const EdgeInsets.only(top: 5, bottom: 5),
                                width: size.width * 0.95,
                                decoration: ShapeDecoration(
                                  color:
                                      const Color.fromARGB(255, 211, 247, 198),
                                  shape: RoundedRectangleBorder(
                                    borderRadius: BorderRadius.circular(10),
                                  ),
                                ),
                                child: CarouselSlider(
                                  carouselController: carouselController,
                                  options: CarouselOptions(
                                    viewportFraction: 1,
                                    enlargeCenterPage: false,
                                    autoPlay: true,
                                    autoPlayInterval:
                                        const Duration(seconds: 4),
                                    autoPlayAnimationDuration:
                                        const Duration(milliseconds: 500),
                                    height: 280,
                                    onPageChanged: (index, reason) {
                                      setState(() {
                                        pageIndex = index;
                                      });
                                    },
                                  ),
                                  items: _addsmodel.map((item) {
                                    return GridTile(
                                      child: Image.network(
                                          '$urlasset/${item.image}',
                                          fit: BoxFit.fill),
                                    );
                                  }).toList(),
                                ),
                              ),
                              CarouselIndicator(
                                count: addsCount,
                                index: pageIndexadds,
                                color: Colors.blue,
                                activeColor: Colors.red,
                              ),
                            ],
                          )
                        : const Text('tidak ada adds'),
                  ],
                ),
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
              icon: Icon(Icons.person),
              label: 'Account',
            ),
          ],
        ),
      ),
    );
  }
}
