import "package:carousel_slider/carousel_slider.dart";
import "package:flutter/material.dart";
import "package:google_map/models/useraccount.dart";
import "package:google_map/pages/chat_screen.dart";
import "package:google_map/pages/customer/transaction_page.dart";
import "package:google_map/pages/dashboard_page.dart";
import "package:google_map/services/network_manager.dart";
import "package:shared_preferences/shared_preferences.dart";

import "../../models/wilayah_model.dart";
import "../account_page.dart";

class EditProfilCustomer extends StatefulWidget {
  const EditProfilCustomer({super.key});

  @override
  State<EditProfilCustomer> createState() => _EditProfilCustomerState();
}

class _EditProfilCustomerState extends State<EditProfilCustomer> {
  int selectedindex = 0;
  String? username = "";
  int? userid;

  bool isLoading = false;
  List<UserAccount> useraccount = [];
  List<Wilayah> propinsi = [];
  List<Wilayah> kabupaten = [];
  List<Wilayah> kecamatan = [];
  List<Wilayah> kelurahan = [];
  String kdpropinsi = '260000';
  String name = '';
  String address = '';
  String email = '';
  String kdkab = '';
  String kdkec = '';
  String gender = '';
  String kdkel = '';

  //String kdpropinsi = '040000';

  final CarouselController carouselController = CarouselController();
  void _ontap(int index) {
    if (index == 0) {
      Navigator.push(context, MaterialPageRoute(builder: (context) {
        return DashboardPage(userid: userid!);
      }));
    } else if (index == 1) {
      Navigator.push(context, MaterialPageRoute(builder: (context) {
        return ChatPage(userid: userid!);
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

  setter() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    setState(() {
      username = prefs.getString('username');
      userid = prefs.getInt('userid');
    });
  }

  void refreshData() async {
    setState(() {
      isLoading = true;
    });
    await NetworkManager().getaccount(userid!).then((value) {
      setState(() {
        if (value.isEmpty) {
          useraccount = [];
        } else {
          useraccount = value;
          name = useraccount[0].name;
          email = useraccount[0].email;
          address = useraccount[0].address;
          kdkel = useraccount[0].kdkel!;
          gender = useraccount[0].gender;
          kdkab = useraccount[0].kdkab!;
          kdkec = useraccount[0].kdkec!;
        }

        NetworkManager().getkabupaten(kdpropinsi).then((value) {
          setState(() {
            kabupaten = value;
          });
        });
        NetworkManager().getkecamatan(kdkab).then((value) {
          setState(() {
            kecamatan = value;
          });
        });
        NetworkManager().getkelurahan(kdkec).then((value) {
          setState(() {
            kelurahan = value;
            isLoading = false;
          });
        });
      });
      isLoading = false;
    });
  }

  ingetkecamatan() {
    isLoading = true;
    NetworkManager().getkecamatan(kdkab).then((value) {
      setState(() {
        kecamatan = value;
        kdkec = kecamatan[0].idwil;
        isLoading = false;
      });
    });
  }

  ingetkelurahan() async {
    isLoading = true;
    await NetworkManager().getkelurahan(kdkec).then((value) {
      setState(() {
        kelurahan = value;
        kdkel = kelurahan[0].idwil;
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

  final _formKey = GlobalKey<FormState>();
  @override
  Widget build(BuildContext context) {
    TextEditingController xname = TextEditingController(text: name.toString());
    TextEditingController xemail = TextEditingController(text: email);
    TextEditingController xaddress = TextEditingController(text: address);

    return Scaffold(
      body: SingleChildScrollView(
        child: SafeArea(
          child: Column(
            mainAxisAlignment: MainAxisAlignment.start,
            children: [
              Container(
                color: const Color.fromARGB(255, 255, 116, 2),
                margin: const EdgeInsets.only(top: 20),
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: [
                    IconButton(
                      onPressed: () {
                        Navigator.pop(context);
                      },
                      icon: const Icon(Icons.arrow_back),
                    ),
                    const Text(
                      "Edit Profil",
                      style: TextStyle(
                        fontSize: 20,
                        fontWeight: FontWeight.bold,
                      ),
                    ),
                    const SizedBox(
                      width: 50,
                    ),
                  ],
                ),
              ),
              Form(
                key: _formKey,
                child: Container(
                  margin: const EdgeInsets.only(top: 20, left: 20, right: 20),
                  child: isLoading
                      ? const Center(
                          child: CircularProgressIndicator(),
                        )
                      : useraccount.isEmpty
                          ? const Center(
                              child: Text('Tidak ada Transaksi'),
                            )
                          : Column(
                              children: [
                                TextFormField(
                                  controller: xname,
                                  decoration: InputDecoration(
                                    labelText: "Username",
                                    hintText: "Username",
                                    border: OutlineInputBorder(
                                      borderRadius: BorderRadius.circular(20),
                                    ),
                                  ),
                                  validator: (value) {
                                    if (value == null || value.isEmpty) {
                                      return 'nama tidak boleh kosong';
                                    }
                                    return null;
                                  },
                                ),
                                const SizedBox(
                                  height: 20,
                                ),
                                TextFormField(
                                  controller: xemail,
                                  decoration: InputDecoration(
                                    labelText: "Email",
                                    hintText: "Email",
                                    border: OutlineInputBorder(
                                      borderRadius: BorderRadius.circular(20),
                                    ),
                                  ),
                                  validator: (value) {
                                    if (value == null || value.isEmpty) {
                                      return 'email tidak boleh kosong';
                                    }
                                    return null;
                                  },
                                ),
                                const SizedBox(
                                  height: 20,
                                ),
                                TextFormField(
                                  controller: xaddress,
                                  decoration: InputDecoration(
                                    labelText: "address",
                                    hintText: "address",
                                    border: OutlineInputBorder(
                                      borderRadius: BorderRadius.circular(20),
                                    ),
                                  ),
                                  validator: (value) {
                                    if (value == null || value.isEmpty) {
                                      return 'Alamat tidak boleh kosong';
                                    }
                                    return null;
                                  },
                                ),
                                const SizedBox(
                                  height: 20,
                                ),
                                Row(
                                  children: [
                                    const Text('Male'),
                                    Radio(
                                        value: "male",
                                        groupValue: gender,
                                        onChanged: (value) {
                                          setState(() {
                                            gender = value.toString();
                                          });
                                        }),
                                    const SizedBox(height: 10),
                                    const Text('Female'),
                                    Radio(
                                        value: "female",
                                        groupValue: gender,
                                        onChanged: (value) {
                                          setState(() {
                                            gender = value.toString();
                                          });
                                        }),
                                  ],
                                ),
                                kabupaten.isEmpty
                                    ? const SizedBox()
                                    : DropdownButtonFormField(
                                        value: kdkab,
                                        hint: const Text('Pilih Kabupaten'),
                                        onChanged: (value) {
                                          setState(() {
                                            kdkab = value.toString();
                                          });
                                          ingetkecamatan();
                                        },
                                        items: kabupaten
                                            .map((e) => DropdownMenuItem(
                                                  value: e.idwil,
                                                  child: Text(e.nmwil),
                                                ))
                                            .toList(),
                                      ),
                                kecamatan.isEmpty
                                    ? const Text('Kecamatan')
                                    : DropdownButtonFormField(
                                        value: kdkec,
                                        hint: const Text('Pilih Kecamatan'),
                                        onChanged: (value) {
                                          setState(() {
                                            kdkec = value.toString();
                                          });
                                          ingetkelurahan();
                                        },
                                        items: kecamatan
                                            .map((e) => DropdownMenuItem(
                                                  value: e.idwil,
                                                  child: Text(e.nmwil),
                                                ))
                                            .toList(),
                                      ),
                                const SizedBox(
                                  height: 20,
                                ),
                                kelurahan.isEmpty
                                    ? const Text('Kelurahan')
                                    : DropdownButtonFormField(
                                        value: kdkel,
                                        hint: const Text('Pilih Kelurahan'),
                                        onChanged: (value) {
                                          setState(() async {
                                            kdkel = value.toString();
                                          });
                                        },
                                        items: kelurahan
                                            .map((e) => DropdownMenuItem(
                                                  value: e.idwil,
                                                  child: Text(e.nmwil),
                                                ))
                                            .toList(),
                                      ),
                                const SizedBox(
                                  height: 20,
                                ),
                                TextButton.icon(
                                  onPressed: () {
                                    if (xname.text.isEmpty ||
                                        xaddress.text.isEmpty ||
                                        xemail.text.isEmpty ||
                                        gender.isEmpty ||
                                        kdkab == '' ||
                                        kdkec == '' ||
                                        kdkel == '') {
                                      ScaffoldMessenger.of(context)
                                          .showSnackBar(
                                        const SnackBar(
                                          content: Text(
                                              'Harap isi semua data terlebih dahulu'),
                                        ),
                                      );
                                      return;
                                    }

                                    final UserAccount item = UserAccount(
                                      id: useraccount[0].id,
                                      name: xname.text,
                                      address: xaddress.text,
                                      email: xemail.text,
                                      gender: gender,
                                      kdkab: kdkab,
                                      kdkec: kdkec,
                                      latitude: 1.1,
                                      longitude: 1.1,
                                      kdkel: kdkel,
                                    );

                                    setState(() {
                                      isLoading = true;
                                      NetworkManager().updateCustomer(item);
                                      isLoading = false;
                                    });

                                    Navigator.push(context,
                                        MaterialPageRoute(builder: (context) {
                                      return const AccountPage();
                                    }));
                                  },
                                  icon: const Icon(Icons.person_2_rounded),
                                  label: const Text("Simpan Profile"),
                                ),
                              ],
                            ),
                ),
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
