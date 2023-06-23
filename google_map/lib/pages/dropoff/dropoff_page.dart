// ignore_for_file: public_member_api_docs, sort_constructors_first
import 'dart:io';

import 'package:flutter/material.dart';
import 'package:google_map/models/dropzone.dart';
import 'package:google_map/models/transaction.dart';

import 'package:google_map/services/cart_dio.dart';
import 'package:google_map/services/network_manager.dart';
import 'package:google_map/widgets/user_imagepicker.dart';
import 'package:intl/intl.dart';

import '../../models/cart.dart';
import '../../widgets/item_widgetdrop.dart';
import 'checkout_page.dart';

class DropoffPage extends StatefulWidget {
  const DropoffPage({
    Key? key,
    this.userid,
  }) : super(key: key);
  final int? userid;

  @override
  State<DropoffPage> createState() => _DropoffPageState();
}

class MyClass {
  String title;
  bool value;
  MyClass(this.title, this.value);
  @override
  String toString() {
    return 'MyClass{title: $title, value: $value}';
  }
}

class _DropoffPageState extends State<DropoffPage> {
  List<MyClass> selecteditems = [];

  final formkey = GlobalKey<FormState>();
  List<Cart> _cart = [];
  late DateTime selectedDate = DateTime.now();
  late TimeOfDay selectedTime = TimeOfDay.now();
  String filename = '';
  double? latitude;
  double? longitude;
  List<DropZone> _dropzone = [];

  int _berattotal = 0;
  File? _userImageFile;
  void _pickedImage(File image) {
    _userImageFile = image;
  }

  final _alamat = TextEditingController();
  final _nomortelepon = TextEditingController();
  final _tanggalpengantaran = TextEditingController();
  final _catatan = TextEditingController();
  int? _dropzoneid;

  String _waktupengantaran = '08.00 - 10.00';
  final dropdownlist = <String>[
    '08.00 - 10.00',
    '10.00 - 12.00',
    '12.00 - 14.00',
  ];

  bool isLoading = false;
  void _selectedDate(BuildContext context) async {
    final DateTime? date = await showDatePicker(
      context: context,
      initialDate: selectedDate,
      firstDate: DateTime(2022),
      lastDate: DateTime(2050),
    );
    if (date != null && date != selectedDate) {
      setState(() {
        selectedDate = date;
        _tanggalpengantaran.text =
            '${selectedDate.day}-${selectedDate.month}-${selectedDate.year}';
      });
    }
  }

  void refreshData(int userid) {
    setState(() {
      isLoading = true;
      _berattotal = 0;
    });
    CartDio().getCart(widget.userid!).then((value) {
      setState(() {
        _cart = value;
        for (int i = 0; i < _cart.length; i++) {
          if (_cart[i].berat != null) {
            int? beratitem = _cart[i].berat;
            _berattotal = _berattotal + beratitem!;
          }
        }
      });
    });
    NetworkManager().getdropzone().then((value) {
      setState(() {
        _dropzone = value;
        isLoading = false;
      });
    });
  }

  @override
  void initState() {
    super.initState();
    refreshData(widget.userid!);
  }

  final _formKey = GlobalKey<FormState>();
  @override
  Widget build(BuildContext context) {
    return Form(
      key: _formKey,
      child: Container(
        decoration: const BoxDecoration(
          image: DecorationImage(
            image: AssetImage("assets/images/background.png"),
            fit: BoxFit.cover,
          ),
        ),
        child: Scaffold(
          backgroundColor: Colors.transparent,
          appBar: AppBar(
            backgroundColor: Colors.transparent,
            elevation: 0,
            title: const Text('Dropoff'),
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
                height: 50,
                color: Colors.transparent,
                margin: const EdgeInsets.only(top: 5),
                child: Image.asset('assets/images/logo.png',
                    width: 100, height: 100),
              ),
              Card(
                margin: const EdgeInsets.all(10),
                elevation: 10,
                child: Container(
                  padding: const EdgeInsets.all(10),
                  child: const Column(
                    children: [
                      Text(
                        'Dropoff',
                        textAlign: TextAlign.center,
                        style: TextStyle(
                          fontSize: 15,
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                      SizedBox(height: 10),
                      Text(
                        'Untuk informasi lokasi pengepul terdekat silahkan klik disini lakukan DROPOFF dilokasi SALIN dengan bonus hadiah/point menarik',
                        textAlign: TextAlign.justify,
                        style: TextStyle(
                            fontSize: 11,
                            fontWeight: FontWeight.bold,
                            color: Color.fromARGB(255, 160, 159, 159)),
                      ),
                    ],
                  ),
                ),
              ),
              Container(
                margin: const EdgeInsets.all(10),
                height: 250,
                child: isLoading
                    ? const Center(
                        child: CircularProgressIndicator(),
                      )
                    : _cart.isEmpty
                        ? const Center(
                            child: Text('Tidak ada Item'),
                          )
                        : Scrollbar(
                            thumbVisibility: true,
                            thickness: 10,
                            child: ListView.builder(
                                itemCount: _cart.length,
                                itemBuilder: (context, index) {
                                  return ItemWidgetDrop(
                                    cart: _cart[index],
                                    userid: widget.userid!,
                                    handleRefresh: () {
                                      refreshData(widget.userid!);
                                    },
                                  );
                                }),
                          ),
              ),
              Container(
                margin: const EdgeInsets.all(15),
                padding: const EdgeInsets.all(5),
                decoration: BoxDecoration(
                    borderRadius: BorderRadius.circular(10),
                    color: const Color.fromARGB(255, 227, 230, 227)),
                child: Column(
                  mainAxisSize: MainAxisSize.min,
                  children: [
                    const SizedBox(height: 5),
                    UserImagePicker(imagePickFn: _pickedImage),
                  ],
                ),
              ),
              Container(
                  margin: const EdgeInsets.all(15),
                  decoration:
                      BoxDecoration(borderRadius: BorderRadius.circular(10)),
                  child: Column(
                    children: [
                      isLoading
                          ? const Center(
                              child: CircularProgressIndicator(),
                            )
                          : _dropzone.isEmpty
                              ? const Center(
                                  child: Text('Tidak ada Item'),
                                )
                              : const Text('Lokasi Pengepul'),
                      DropdownButton(
                        hint: const Text('Lokasi Pengepul '),
                        value: _dropzoneid,
                        items: _dropzone
                            .map((item) => DropdownMenuItem(
                                  value: item.id,
                                  child: Text(item.name.toString()),
                                ))
                            .toList(),
                        onChanged: (newValue) {
                          setState(() {
                            _dropzoneid = newValue as int;
                          });
                        },
                      ),
                      const SizedBox(height: 10),
                      TextFormField(
                        controller: _nomortelepon,
                        decoration: const InputDecoration(
                            hintText: 'No. Handphone',
                            border: OutlineInputBorder(),
                            labelText: 'No. Handphone'),
                        keyboardType: TextInputType.number,
                        validator: (value) {
                          if (value == null || value.isEmpty) {
                            return 'No. Handphone tidak boleh kosong';
                          }
                          return null;
                        },
                      ),
                      const SizedBox(height: 10),
                      TextFormField(
                        controller: _alamat,
                        decoration: const InputDecoration(
                            hintText: 'Alamat',
                            border: OutlineInputBorder(),
                            labelText: 'Alamat'),
                        validator: (value) {
                          if (value == null || value.isEmpty) {
                            return 'Alamat tidak boleh kosong';
                          }
                          return null;
                        },
                      ),
                      const SizedBox(height: 10),
                      TextFormField(
                        controller: _tanggalpengantaran,
                        decoration: const InputDecoration(
                            hintText: 'Tanggal Pengantaran',
                            border: OutlineInputBorder(),
                            suffixIcon: Icon(Icons.calendar_today),
                            labelText: 'Tanggal Pengantaran'),
                        onTap: () {
                          _selectedDate(context);
                        },
                        validator: (value) {
                          if (value == null || value.isEmpty) {
                            return 'Tanggal Pengantaran tidak boleh kosong';
                          }
                          return null;
                        },
                      ),
                      const SizedBox(height: 10),
                      const Text('Waktu Pengantaran'),
                      DropdownButton(
                        value: _waktupengantaran,
                        items: dropdownlist
                            .map((e) => DropdownMenuItem(
                                  value: e,
                                  child: Text(e),
                                ))
                            .toList(),
                        onChanged: (String? val) {
                          setState(() {
                            if (val != null) {
                              _waktupengantaran = val;
                            }
                          });
                        },
                      ),
                      const SizedBox(height: 10),
                      TextFormField(
                        controller: _catatan,
                        decoration: const InputDecoration(
                            hintText: 'Informasi Tambahan',
                            border: OutlineInputBorder(),
                            labelText: 'Informasi Tambahan'),
                        validator: (value) {
                          if (value == null || value.isEmpty) {
                            return 'Catatan tidak boleh kosong';
                          }
                          return null;
                        },
                      ),
                      const SizedBox(height: 10),
                      Container(
                        padding: const EdgeInsets.all(5),
                        width: double.infinity,
                        height: 50,
                        decoration: const BoxDecoration(
                            color: Color.fromARGB(255, 250, 115, 5)),
                        child: Row(
                          mainAxisAlignment: MainAxisAlignment.spaceBetween,
                          children: [
                            Text(
                              'Total berat: $_berattotal kg',
                              style: const TextStyle(color: Colors.white),
                            ),
                            TextButton.icon(
                                onPressed: () {
                                  if (_dropzoneid == 0 ||
                                      _nomortelepon.text.isEmpty ||
                                      _alamat.text.isEmpty ||
                                      _tanggalpengantaran.text.isEmpty ||
                                      _waktupengantaran.isEmpty ||
                                      _catatan.text.isEmpty) {
                                    ScaffoldMessenger.of(context).showSnackBar(
                                      const SnackBar(
                                        content: Text(
                                            'Harap isi semua data terlebih dahulu'),
                                      ),
                                    );
                                    return;
                                  }
                                  DateFormat dateFormat =
                                      DateFormat("yyyy-MM-dd");
                                  final Transaction item = Transaction(
                                    dropzoneid: _dropzoneid!,
                                    customerid: widget.userid!,
                                    address: _alamat.text,
                                    nohp: _nomortelepon.text,
                                    datepickup: dateFormat.format(selectedDate),
                                    type: "drop",
                                    time: _waktupengantaran,
                                    catatan: _catatan.text,
                                    weight: _berattotal.toInt(),
                                    status: 'pending',
                                  );

                                  Navigator.push(
                                    context,
                                    MaterialPageRoute(
                                      builder: (context) => CheckoutDropPage(
                                          key: UniqueKey(),
                                          transaction: item,
                                          filegambar: _userImageFile!),
                                    ),
                                  );
                                },
                                icon: const Icon(
                                  Icons.fast_forward,
                                  color: Colors.white,
                                ),
                                label: const Text(
                                  'Selanjutnya',
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
      ),
    );
  }
}
