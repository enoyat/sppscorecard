// ignore_for_file: public_member_api_docs, sort_constructors_first

import "package:flutter/material.dart";
import "package:sppscorecard_app/pages/mekanik/listofmaintenanace_page.dart";
import "package:sppscorecard_app/pages/mekanik/listunitsparepart_page.dart";
import "package:sppscorecard_app/widgets/profil_widget.dart";
import "package:intl/intl.dart";
import "package:shared_preferences/shared_preferences.dart";

import "package:sppscorecard_app/pages/mekanik/listoftrouble_page.dart";

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
  Map<String, dynamic> _profil = <String, dynamic>{};

  setter() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    Future.delayed(const Duration(seconds: 1), () {
      setState(() {
        username = prefs.getString('username');
        userid = prefs.getInt('userid');
        _profil = {
          'iduser': prefs.getInt('userid')!,
          'namauser': prefs.getString('username')!,
          'idcbu': prefs.getString('idcbu')!,
          'idregion': prefs.getString('idregion')!,
          'idsitename': prefs.getString('idsitename')!,
          'namacbu': prefs.getString('namacbu')!,
          'namaregion': prefs.getString('namaregion')!,
          'namasitename': prefs.getString('namasitename')!,
          'urlapi': prefs.getString('urlapi')!,
        };
      });
    });
  }

  void refreshData() {
    setState(() {
      isLoading = false;
    });
  }

  @override
  void initState() {
    super.initState();
    setter();
  }

  void _logout() async {
    SharedPreferences preferences = await SharedPreferences.getInstance();
    await preferences.clear();
    if (!mounted) return;
    Navigator.pushReplacement(context, MaterialPageRoute(builder: (context) {
      return const LoginPage();
    }));
  }

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
                              ],
                            ),
                          ),
                          Card(
                            margin: const EdgeInsets.all(20),
                            color: const Color.fromARGB(255, 215, 252, 6),
                            child: ListTile(
                              leading: const Icon(
                                Icons.person,
                                color: Color.fromARGB(255, 99, 97, 97),
                                size: 40,
                              ),
                              title: const Text(
                                "Selamat Datang",
                                style: TextStyle(
                                  fontSize: 15,
                                  fontWeight: FontWeight.bold,
                                ),
                              ),
                              subtitle: Text(
                                username!,
                                style: const TextStyle(
                                  fontSize: 15,
                                  fontWeight: FontWeight.bold,
                                ),
                              ),
                            ),
                          ),
                        ],
                      ),
                      const SizedBox(height: 10),
                      isLoading
                          ? const CircularProgressIndicator()
                          : _profil.isEmpty
                              ? const CircularProgressIndicator()
                              : ProfilWidget(
                                  profil:
                                      _profil), // ignore: prefer_const_constructors
                      Padding(
                        padding: const EdgeInsets.only(left: 20, right: 20),
                        child: GridView.count(
                            crossAxisCount: 3,
                            shrinkWrap: true,
                            children: [
                              Card(
                                color: const Color.fromARGB(255, 221, 82, 2),
                                elevation: 5,
                                shape: RoundedRectangleBorder(
                                  borderRadius: BorderRadius.circular(10),
                                ),
                                child: InkWell(
                                  onTap: () {
                                    Navigator.push(context,
                                        MaterialPageRoute(builder: (context) {
                                      return ListOfTroublePage(
                                        profil: _profil,
                                      );
                                    }));
                                  },
                                  child: Column(
                                    mainAxisAlignment: MainAxisAlignment.center,
                                    children: [
                                      Image.asset(
                                        'assets/images/trouble.png',
                                        width: 60,
                                        height: 60,
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
                                color: const Color.fromARGB(255, 7, 248, 39),
                                elevation: 5,
                                shape: RoundedRectangleBorder(
                                  borderRadius: BorderRadius.circular(10),
                                ),
                                child: InkWell(
                                  onTap: () {
                                    Navigator.push(context,
                                        MaterialPageRoute(builder: (context) {
                                      return ListOfMaintenancePage(
                                        profil: _profil,
                                      );
                                    }));
                                  },
                                  child: Column(
                                    mainAxisAlignment: MainAxisAlignment.center,
                                    children: [
                                      Image.asset(
                                        'assets/images/maintenance.png',
                                        width: 60,
                                        height: 60,
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
                              // Card(
                              //   color: const Color.fromARGB(255, 43, 40, 226),
                              //   elevation: 5,
                              //   shape: RoundedRectangleBorder(
                              //     borderRadius: BorderRadius.circular(10),
                              //   ),
                              //   child: InkWell(
                              //     onTap: () {
                              //       // Navigator.push(context,
                              //       //     MaterialPageRoute(builder: (context) {
                              //       //   return ListOfTroublePage(
                              //       //     profil: _profil,
                              //       //   );
                              //       // }));
                              //     },
                              //     child: Column(
                              //       mainAxisAlignment: MainAxisAlignment.center,
                              //       children: [
                              //         Image.asset(
                              //           'assets/images/pallet.png',
                              //           width: 70,
                              //           height: 70,
                              //         ),
                              //         const SizedBox(height: 10),
                              //         const Text(
                              //           'Pallete',
                              //           style: TextStyle(
                              //             fontSize: 15,
                              //             fontWeight: FontWeight.bold,
                              //           ),
                              //         ),
                              //       ],
                              //     ),
                              //   ),
                              // ),
                              Card(
                                color: const Color.fromARGB(255, 205, 15, 158),
                                elevation: 5,
                                shape: RoundedRectangleBorder(
                                  borderRadius: BorderRadius.circular(10),
                                ),
                                child: InkWell(
                                  onTap: () {
                                    Navigator.push(context,
                                        MaterialPageRoute(builder: (context) {
                                      return ListOfUnitSparepartPage(
                                        profil: _profil,
                                      );
                                    }));
                                  },
                                  child: Column(
                                    mainAxisAlignment: MainAxisAlignment.center,
                                    children: [
                                      Image.asset(
                                        'assets/images/spare-parts.png',
                                        width: 60,
                                        height: 60,
                                      ),
                                      const SizedBox(height: 10),
                                      const Text(
                                        'Sparepart',
                                        style: TextStyle(
                                          fontSize: 15,
                                          fontWeight: FontWeight.bold,
                                        ),
                                      ),
                                    ],
                                  ),
                                ),
                              ),
                            ]),
                      )
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
