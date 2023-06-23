import 'package:flutter/material.dart';
import 'package:google_map/models/register.dart';
import 'package:google_map/pages/login.dart';
import 'package:google_map/services/transaction_dio.dart';

import '../models/wilayah_model.dart';
import '../services/network_manager.dart';

class RegisterPage extends StatefulWidget {
  const RegisterPage({super.key});

  @override
  State<RegisterPage> createState() => _RegisterPageState();
}

class _RegisterPageState extends State<RegisterPage> {
  final _formKey = GlobalKey<FormState>();
  final username = TextEditingController();
  final email = TextEditingController();
  final address = TextEditingController();
  final rt = TextEditingController();
  final rw = TextEditingController();
  final nohp = TextEditingController();
  String gender = "";
  final password = TextEditingController();
  List<Wilayah> kabupaten = [];
  List<Wilayah> kecamatan = [];
  List<Wilayah> kelurahan = [];
  String kdpropinsi = '260000';
  bool isLoading = false;
  String kdkab = '';
  String kdkec = '';
  String kdkel = '';

  void refreshdata() {
    setState(() {
      isLoading = true;
    });

    NetworkManager().getkabupaten(kdpropinsi).then((value) {
      setState(() {
        kabupaten = value;
        isLoading = false;
      });
    });
  }

  ingetkecamatan() {
    setState(() {
      isLoading = true;
    });

    NetworkManager().getkecamatan(kdkab).then((value) {
      setState(() {
        kecamatan = value;
        kdkec = kecamatan[0].idwil;
        isLoading = false;
      });
    });
  }

  ingetkelurahan() {
    setState(() {
      isLoading = true;
    });

    NetworkManager().getkelurahan(kdkec).then((value) {
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
    refreshdata();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: SingleChildScrollView(
        child: Form(
          key: _formKey,
          child: Column(
            children: [
              Container(
                  height: 60,
                  margin: const EdgeInsets.only(top: 50),
                  decoration: const BoxDecoration(
                    image: DecorationImage(
                      image: AssetImage('assets/images/logo.png'),
                      fit: BoxFit.contain,
                    ),
                  )),
              const SizedBox(height: 20),
              const Center(
                child: Text('Register Page', style: TextStyle(fontSize: 20)),
              ),
              const SizedBox(height: 20),
              Container(
                margin: const EdgeInsets.only(left: 20, right: 20),
                child: TextFormField(
                  controller: username,
                  decoration: const InputDecoration(
                    border: OutlineInputBorder(),
                    labelText: 'Username',
                  ),
                  validator: (value) {
                    if (value == null || value.isEmpty) {
                      return 'Please enter your username';
                    }
                    return null;
                  },
                ),
              ),
              const SizedBox(height: 20),
              Container(
                margin: const EdgeInsets.only(left: 20, right: 20),
                child: TextFormField(
                  controller: email,
                  decoration: const InputDecoration(
                      border: OutlineInputBorder(), labelText: 'email'),
                  keyboardType: TextInputType.emailAddress,
                  validator: (value) {
                    if (value == null || value.isEmpty) {
                      return 'Please enter your email';
                    }
                    return null;
                  },
                ),
              ),
              const SizedBox(height: 20),
              Container(
                margin: const EdgeInsets.only(left: 20, right: 20),
                child: Row(
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
              ),
              const SizedBox(height: 20),
              Container(
                margin: const EdgeInsets.only(left: 20, right: 20),
                child: TextFormField(
                  controller: password,
                  decoration: const InputDecoration(
                      border: OutlineInputBorder(), labelText: 'password'),
                  obscureText: true,
                  validator: (value) {
                    if (value == null || value.isEmpty) {
                      return 'Please enter your password';
                    }
                    return null;
                  },
                ),
              ),
              const SizedBox(height: 20),
              Container(
                margin: const EdgeInsets.only(left: 20, right: 20),
                child: TextFormField(
                  controller: address,
                  decoration: const InputDecoration(
                      border: OutlineInputBorder(), labelText: 'alamat'),
                  validator: (value) {
                    if (value == null || value.isEmpty) {
                      return 'alamat';
                    }
                    return null;
                  },
                ),
              ),
              Container(
                margin: const EdgeInsets.only(left: 20, right: 20),
                child: kabupaten.isEmpty
                    ? const SizedBox()
                    : DropdownButtonFormField(
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
              ),
              Container(
                margin: const EdgeInsets.only(left: 20, right: 20),
                child: isLoading
                    ? const Center(
                        child: CircularProgressIndicator(),
                      )
                    : kecamatan.isEmpty
                        ? const SizedBox(
                            height: 5,
                          )
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
              ),
              Container(
                margin: const EdgeInsets.only(left: 20, right: 20),
                child: isLoading
                    ? const Center(
                        child: CircularProgressIndicator(),
                      )
                    : kelurahan.isEmpty
                        ? const SizedBox(
                            height: 5,
                          )
                        : DropdownButtonFormField(
                            value: kdkel,
                            hint: const Text('Pilih Kelurahan'),
                            onChanged: (value) {
                              setState(() {
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
              ),
              const SizedBox(
                height: 20,
              ),
              const SizedBox(height: 20),
              Container(
                margin: const EdgeInsets.only(left: 20, right: 20),
                child: TextFormField(
                  controller: rw,
                  decoration: const InputDecoration(
                      border: OutlineInputBorder(), labelText: 'RW'),
                  validator: (value) {
                    if (value == null || value.isEmpty) {
                      return 'RW';
                    }
                    return null;
                  },
                ),
              ),
              const SizedBox(height: 20),
              Container(
                margin: const EdgeInsets.only(left: 20, right: 20),
                child: TextFormField(
                  controller: rt,
                  decoration: const InputDecoration(
                      border: OutlineInputBorder(), labelText: 'RT'),
                  validator: (value) {
                    if (value == null || value.isEmpty) {
                      return 'RT';
                    }
                    return null;
                  },
                ),
              ),
              const SizedBox(height: 20),
              Container(
                margin: const EdgeInsets.only(left: 20, right: 20),
                child: TextFormField(
                  controller: nohp,
                  keyboardType: TextInputType.number,
                  decoration: const InputDecoration(
                      border: OutlineInputBorder(), labelText: 'No. HP'),
                  validator: (value) {
                    if (value == null || value.isEmpty) {
                      return 'No. Hp';
                    }
                    return null;
                  },
                ),
              ),
              const SizedBox(height: 20),
              Container(
                margin: const EdgeInsets.only(left: 20, right: 20),
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    ElevatedButton(
                      onPressed: () async {
                        final RegisterModel item = RegisterModel(
                            password: password.text,
                            name: username.text,
                            gender: gender.toString(),
                            address: address.text,
                            latitude: 1.1,
                            longitude: 2.1,
                            email: email.text,
                            kdkab: kdkab,
                            kdkec: kdkec,
                            kdkel: kdkel,
                            rw: rw.text,
                            rt: rt.text,
                            nohp: nohp.text);
                        if (_formKey.currentState!.validate()) {
                          ScaffoldMessenger.of(context).showSnackBar(
                              const SnackBar(content: Text('Processing Data')));

                          await TransactionDio().register(item).then((value) {
                            value["status"] == false
                                ? ScaffoldMessenger.of(context).showSnackBar(
                                    const SnackBar(
                                        content: Text(
                                            'Register Failed, cek kembali data anda')))
                                : ScaffoldMessenger.of(context).showSnackBar(
                                    const SnackBar(
                                        content: Text('Register Success')));
                            Future.delayed(
                                const Duration(seconds: 5)
                                // ignore: avoid_types_on_closure_parameters
                                , () {
                              Navigator.pushAndRemoveUntil(
                                context,
                                MaterialPageRoute(
                                  builder: (BuildContext context) =>
                                      const LoginPage(),
                                ),
                                (route) => false,
                              );
                            });
                          });
                        }
                      },
                      child: const Text('Daftar'),
                    ),
                    const SizedBox(width: 20),
                    ElevatedButton(
                      onPressed: () {
                        Navigator.pop(context);
                      },
                      child: const Text('Batal'),
                    ),
                  ],
                ),
              ),
              const SizedBox(height: 20),
            ],
          ),
        ),
      ),
    );
  }
}
