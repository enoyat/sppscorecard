// ignore_for_file: public_member_api_docs, sort_constructors_first
import 'dart:io';

import 'package:flutter/material.dart';

import 'package:google_map/models/dokumentrouble.dart';
import 'package:google_map/pages/mekanik/listoftrouble_page.dart';
import 'package:google_map/widgets/user_imagepicker.dart';
import 'package:shared_preferences/shared_preferences.dart';

import '../../models/trouble.dart';
import '../../services/trouble_dio.dart';

class FormTroublePage extends StatefulWidget {
  const FormTroublePage({
    Key? key,
    this.idtrouble,
  }) : super(key: key);
  final int? idtrouble;

  @override
  State<FormTroublePage> createState() => _FormTroublePageState();
}

class _FormTroublePageState extends State<FormTroublePage> {
  final formkey = GlobalKey<FormState>();
  late DateTime selectedtanggalpengerjaan = DateTime.now();
  late DateTime selectedwaktupengerjaan = DateTime.now();
  late TimeOfDay selectedTime = TimeOfDay.now();
  String filename = '';
  int? userid = 0;
  setter() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    setState(() {
      userid = prefs.getInt('userid');
    });
  }

  File? _userImageFile;

  void _pickedImage(File image) {
    _userImageFile = image;
  }

  _pilihtanggalpengerjaan() async {
    final DateTime? date = await showDatePicker(
      context: context,
      initialDate: selectedtanggalpengerjaan,
      firstDate: DateTime(2021),
      lastDate: DateTime(2040),
    );
    if (date != null && date != selectedtanggalpengerjaan) {
      setState(() {
        selectedtanggalpengerjaan = date;
        _tanggalpengerjaan.text =
            '${selectedtanggalpengerjaan.day}-${selectedtanggalpengerjaan.month}-${selectedtanggalpengerjaan.year}';
      });
    }
  }

  _pilihwaktupengerjaan() async {
    final DateTime? date = await showDatePicker(
      context: context,
      initialDate: selectedwaktupengerjaan,
      firstDate: DateTime(2021),
      lastDate: DateTime(2040),
    );
    if (date != null && date != selectedwaktupengerjaan) {
      setState(() {
        selectedwaktupengerjaan = date;
        _waktuselesaipengerjaan.text =
            '${selectedwaktupengerjaan.day}-${selectedwaktupengerjaan.month}-${selectedwaktupengerjaan.year}';
      });
    }
  }

  final _tanggalpengerjaan = TextEditingController();
  final _waktuselesaipengerjaan = TextEditingController();
  final _deskripsi = TextEditingController();
  final _sparepart = TextEditingController();
  List<String> dokumen = [];

  List<Trouble> _trouble = [];

  List<Dokumentrouble> _listdokumen = [];
  String status = "";
  String _shift = 'shift 1';
  String _dokumen = 'Before Unit';
  final shiftlist = <String>[
    'shift 1',
    'shift 2',
    'shift 3',
  ];
  final dokumentlist = <String>[
    'Before Unit',
    'Kegiatan Pengerjaan',
    'After Unit',
    'Service Report',
    'Checklist',
    'Dokumen Lainnya'
  ];
  bool isLoading = false;
  void refreshData() {
    setState(() {
      isLoading = true;
    });
    TroubleDio().gettrouble(widget.idtrouble!).then((value) {
      setState(() {
        _trouble = value;
        isLoading = false;
      });
    });
    TroubleDio().listdokumen(widget.idtrouble!).then((value) {
      setState(() {
        _listdokumen = value;
        isLoading = false;
      });
    });
  }

  uploadgambar() {
    TroubleDio()
        .uploadfoto(_userImageFile!, widget.idtrouble!, _dokumen)
        .then((value) => filename = value);
    setState(() {
      refreshData();
    });
  }

  @override
  void initState() {
    super.initState();
    setter();
    refreshData();
  }

  final _formKey = GlobalKey<FormState>();
  @override
  Widget build(BuildContext context) {
    return Form(
      key: _formKey,
      child: Scaffold(
        appBar: AppBar(
          elevation: 0,
          title: const Text('Form Trouble'),
          actions: [
            IconButton(
              onPressed: () {
                Navigator.pop(context);
              },
              icon: const Icon(Icons.close),
            ),
          ],
        ),
        body: ListView(
          children: [
            Container(
              margin: const EdgeInsets.all(10),
              height: 80,
              width: 250,
              child: Card(
                margin: const EdgeInsets.only(top: 5, bottom: 5),
                color: const Color.fromARGB(255, 245, 224, 250),
                elevation: 5,
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(10),
                ),
                child: _trouble.isEmpty
                    ? const Center(child: CircularProgressIndicator())
                    : Column(
                        children: [
                          const SizedBox(height: 10),
                          Text('Id Trouble : ${_trouble[0].id}',
                              textAlign: TextAlign.left,
                              style: const TextStyle(
                                fontSize: 10,
                                fontWeight: FontWeight.bold,
                              )),
                          Text('Issue : ${_trouble[0].issue}',
                              textAlign: TextAlign.left,
                              style: const TextStyle(
                                fontSize: 10,
                                fontWeight: FontWeight.bold,
                              )),
                          Text('Kode Unit: ${_trouble[0].kdunit}',
                              style: const TextStyle(
                                fontSize: 10,
                                fontWeight: FontWeight.bold,
                              )),
                          Text(
                              'Target Complette date ${_trouble[0].targetcompletedate}',
                              style: const TextStyle(
                                fontSize: 10,
                                fontWeight: FontWeight.bold,
                              ))
                        ],
                      ),
              ),
            ),
            Container(
                margin: const EdgeInsets.all(15),
                decoration:
                    BoxDecoration(borderRadius: BorderRadius.circular(10)),
                child: Column(
                  children: [
                    TextFormField(
                      enabled: true,
                      controller: _tanggalpengerjaan,
                      decoration: const InputDecoration(
                          hintText: 'Tanggal Pengerjaan',
                          border: OutlineInputBorder(),
                          suffixIcon: Icon(Icons.calendar_today),
                          labelText: 'Tanggal Pengerjaan'),
                      onTap: () {
                        _pilihtanggalpengerjaan();
                      },
                      validator: (value) {
                        if (value == null || value.isEmpty) {
                          return 'Tanggal Pengerjaan tidak boleh kosong';
                        }
                        return null;
                      },
                    ),
                    const SizedBox(height: 10),
                    const Text('Shift'),
                    DropdownButton(
                      value: _shift,
                      items: shiftlist
                          .map((e) => DropdownMenuItem(
                                value: e,
                                child: Text(e),
                              ))
                          .toList(),
                      onChanged: (String? val) {
                        setState(() {
                          if (val != null) {
                            _shift = val;
                          }
                        });
                      },
                    ),
                    TextFormField(
                      enabled: true,
                      controller: _deskripsi,
                      decoration: const InputDecoration(
                          hintText: 'Deskripsi Pengerjaan',
                          border: OutlineInputBorder(),
                          suffixIcon: Icon(Icons.abc),
                          labelText: 'Deskripsi Pengerjaan'),
                      onTap: () {},
                      validator: (value) {
                        if (value == null || value.isEmpty) {
                          return 'Deskripsi Pengerjaan tidak boleh kosong';
                        }
                        return null;
                      },
                    ),
                    const SizedBox(height: 10),
                    TextFormField(
                      enabled: true,
                      controller: _sparepart,
                      decoration: const InputDecoration(
                          hintText: 'Pemakaian Sparepart',
                          border: OutlineInputBorder(),
                          suffixIcon: Icon(Icons.abc),
                          labelText: 'Pemakaian Sparepart'),
                      onTap: () {},
                      validator: (value) {
                        if (value == null || value.isEmpty) {
                          return 'Pemakaian  tidak boleh kosong';
                        }
                        return null;
                      },
                    ),
                    const SizedBox(height: 10),
                    TextFormField(
                      enabled: true,
                      controller: _waktuselesaipengerjaan,
                      decoration: const InputDecoration(
                          hintText: 'Waktu Selesai Pengerjaan',
                          border: OutlineInputBorder(),
                          suffixIcon: Icon(Icons.calendar_today),
                          labelText: 'Waktu Selesai Pengerjaan'),
                      onTap: () {
                        _pilihwaktupengerjaan();
                      },
                      validator: (value) {
                        if (value == null || value.isEmpty) {
                          return 'Waktu Selesai Pengerjaan tidak boleh kosong';
                        }
                        return null;
                      },
                    ),
                    const SizedBox(height: 10),
                    const Text('Status: '),
                    Container(
                      margin: const EdgeInsets.only(left: 20, right: 20),
                      child: Row(
                        mainAxisAlignment: MainAxisAlignment.spaceBetween,
                        children: [
                          Radio(
                              value: "OPEN",
                              groupValue: status,
                              onChanged: (value) {
                                setState(() {
                                  status = value.toString();
                                });
                              }),
                          const Text('OPEN'),
                          const SizedBox(height: 10),
                          Radio(
                              value: "CLOSE",
                              groupValue: status,
                              onChanged: (value) {
                                setState(() {
                                  status = value.toString();
                                });
                              }),
                          const Text('CLOSE'),
                          const SizedBox(height: 10),
                          Radio(
                              value: "CONTINUE",
                              groupValue: status,
                              onChanged: (value) {
                                setState(() {
                                  status = value.toString();
                                });
                              }),
                          const Text('CONTINUE'),
                        ],
                      ),
                    ),
                    const SizedBox(height: 10),
                    Container(
                      margin: const EdgeInsets.all(15),
                      padding: const EdgeInsets.all(5),
                      decoration: BoxDecoration(
                          borderRadius: BorderRadius.circular(10),
                          color: const Color.fromARGB(255, 227, 230, 227)),
                      child: Column(
                        mainAxisSize: MainAxisSize.min,
                        children: [
                          const Text('Foto Gambar'),
                          DropdownButton(
                            value: _dokumen,
                            items: dokumentlist
                                .map((e) => DropdownMenuItem(
                                      value: e,
                                      child: Text(e),
                                    ))
                                .toList(),
                            onChanged: (String? val) {
                              setState(() {
                                if (val != null) {
                                  _dokumen = val;
                                }
                              });
                            },
                          ),
                          const SizedBox(height: 5),
                          UserImagePicker(imagePickFn: _pickedImage),
                          ElevatedButton(
                              onPressed: () async {
                                uploadgambar();
                                ScaffoldMessenger.of(context).showSnackBar(
                                    const SnackBar(
                                        content: Text('Upload  Success')));
                                refreshData();
                              },
                              child: const Text('Upload')),
                          ElevatedButton(
                              onPressed: () {
                                refreshData();
                              },
                              child: const Text('Refresh')),
                          _listdokumen.isEmpty
                              ? const Text('Gambar belum diupload')
                              : SizedBox(
                                  height: 100,
                                  child: ListView.builder(
                                      scrollDirection: Axis.horizontal,
                                      itemCount: _listdokumen.length,
                                      itemBuilder: (context, index) {
                                        return Container(
                                          margin: const EdgeInsets.all(5),
                                          child: Card(
                                              child: Image.network(
                                            'https://satriapirantiperkasa.com/assets/inventory/${_listdokumen[index].filename}',
                                          )),
                                        );
                                      }),
                                ),
                        ],
                      ),
                    ),
                    Container(
                      padding: const EdgeInsets.all(5),
                      width: double.infinity,
                      height: 50,
                      decoration: const BoxDecoration(
                          color: Color.fromARGB(255, 250, 115, 5)),
                      child: Row(
                        mainAxisAlignment: MainAxisAlignment.spaceBetween,
                        children: [
                          TextButton.icon(
                              onPressed: () {
                                if (_shift.isEmpty ||
                                    _waktuselesaipengerjaan.text.isEmpty ||
                                    _sparepart.text.isEmpty ||
                                    _deskripsi.text.isEmpty ||
                                    status.isEmpty) {
                                  ScaffoldMessenger.of(context).showSnackBar(
                                    const SnackBar(
                                      content: Text(
                                          'Harap isi semua data terlebih dahulu'),
                                    ),
                                  );
                                  return;
                                }

                                final Map<String, dynamic> itemdetail = {
                                  'idtrouble': widget.idtrouble!,
                                  'iduser': userid!,
                                  'tanggalmulai': _tanggalpengerjaan.text,
                                  'shift': _shift,
                                  'statusmekanik': status,
                                  'documentation': 'sudah upload',
                                  'deskripsi': _deskripsi.text,
                                  'sparepart': _sparepart.text,
                                  'waktuselesaipengerjaan':
                                      _waktuselesaipengerjaan.text,
                                };
                                setState(() => isLoading = true);
                                TroubleDio().postData(itemdetail).then((value) {
                                  setState(() {
                                    isLoading = false;
                                  });
                                });
                                Future.delayed(const Duration(seconds: 3), () {
                                  setState(() => isLoading = false);
                                  Navigator.pushAndRemoveUntil(
                                    context,
                                    MaterialPageRoute(
                                        builder: (BuildContext context) =>
                                            const ListOfTroublePage()),
                                    (route) => false,
                                  );
                                });
                              },
                              icon: const Icon(
                                Icons.fast_forward,
                                color: Colors.white,
                              ),
                              label: const Text(
                                'Simpan Proses Pengerjaan',
                                style: TextStyle(color: Colors.white),
                              )),
                        ],
                      ),
                    ),
                  ],
                )),
          ],
        ),
      ),
    );
  }
}
