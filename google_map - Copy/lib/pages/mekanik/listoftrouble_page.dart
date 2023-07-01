// ignore_for_file: public_member_api_docs, sort_constructors_first
import "package:flutter/material.dart";
import "package:shared_preferences/shared_preferences.dart";

import "package:google_map/models/trouble.dart";
import "package:google_map/pages/dashboard_page.dart";
import "package:google_map/services/trouble_dio.dart";
import "package:google_map/widgets/itemtrouble_widget.dart";

class ListOfTroublePage extends StatefulWidget {
  const ListOfTroublePage({
    Key? key,
    this.profil,
  }) : super(key: key);
  final Map<String, dynamic>? profil;

  @override
  State<ListOfTroublePage> createState() => _ListOfTroublePage();
}

class _ListOfTroublePage extends State<ListOfTroublePage> {
  int selectedindex = 0;
  String? nama = "";
  int? userid;
  bool isLoading = false;
  List<Trouble> _trouble = [];
  int? idsitename;
  void refreshData() async {
    setState(() {
      isLoading = true;
      idsitename = widget.profil!['idsitename'];
    });

    await TroubleDio().listoftrouble(idsitename!).then((value) {
      setState(() {
        _trouble = value;
        isLoading = false;
      });
    });
  }

  @override
  void initState() {
    super.initState();
    setter();
    refreshData();

//
  }

  setter() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    setState(() {
      userid = prefs.getInt('userid');
    });
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
              child: Row(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                children: [
                  IconButton(
                    onPressed: () {
                      Navigator.push(context,
                          MaterialPageRoute(builder: (context) {
                        return DashboardPage(userid: userid!);
                      }));
                    },
                    icon: const Icon(Icons.arrow_back),
                  ),
                  const Text(
                    "List Of Trouble",
                    textAlign: TextAlign.center,
                    style: TextStyle(
                      fontSize: 20,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                  IconButton(
                    onPressed: () {
                      return refreshData();
                    },
                    icon: const Icon(Icons.refresh),
                  ),
                ],
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
                    child: _trouble.isEmpty
                        ? const Center(
                            child: Text('Tidak ada Transaksi'),
                          )
                        : ListView.builder(
                            itemCount: _trouble.length,
                            itemBuilder: (context, index) {
                              return ItemTroubleWidget(
                                trouble: _trouble[index],
                                handleRefresh: refreshData,
                              );
                            }),
                  ),
          ],
        ),
      ),
    );
  }
}
