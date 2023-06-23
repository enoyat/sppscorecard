// ignore_for_file: public_member_api_docs, sort_constructors_first
import 'dart:io';

import 'package:flutter/material.dart';
import 'package:google_map/models/transaction.dart';
import 'package:google_map/pages/map_page.dart';

import 'package:google_map/services/cart_dio.dart';
import 'package:google_map/shared/shared_bio.dart';
import 'package:google_map/widgets/item_widget.dart';
import 'package:google_map/widgets/user_imagepicker.dart';
import 'package:intl/intl.dart';

import '../models/cart.dart';
import 'checkout_page.dart';

class PenjemputanPage extends StatefulWidget {
  const PenjemputanPage({
    Key? key,
    this.userid,
  }) : super(key: key);
  final int? userid;

  @override
  State<PenjemputanPage> createState() => _PenjemputanPageState();
}

class _PenjemputanPageState extends State<PenjemputanPage> {
  final formkey = GlobalKey<FormState>();
  List<Cart> _cart = [];
  late DateTime selectedDate = DateTime.now().add(const Duration(days: 1));
  late TimeOfDay selectedTime = TimeOfDay.now();
  String filename = '';
  double? latitude;
  double? longitude;

  int _berattotal = 0;
  File? _userImageFile;

  void _pickedImage(File image) {
    _userImageFile = image;
  }

  final _alamatpenjemputan = TextEditingController();
  final _geolokasi = TextEditingController();

  final _nomortelepon = TextEditingController();
  final _tanggalpenjemputan = TextEditingController();
  final _catatan = TextEditingController();

  String _waktupenjemputan = '08.00 - 10.00';
  final dropdownlist = <String>[
    '08.00 - 10.00',
    '10.00 - 12.00',
    '12.00 - 14.00',
  ];

  bool isLoading = false;
  final FocusNode _alamatFocusNode = FocusNode();

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

        isLoading = false;
      });
    });
  }

  @override
  void initState() {
    super.initState();
    refreshData(widget.userid!);
    _tanggalpenjemputan.text =
        '${selectedDate.day}-${selectedDate.month}-${selectedDate.year}';
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
            title: const Text('Pickup'),
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
                        'Pickup',
                        textAlign: TextAlign.center,
                        style: TextStyle(
                          fontSize: 15,
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                      SizedBox(height: 10),
                      Text(
                        'Silahkan pilih Jenis Sampah mu, dan perkiranan berat sampahmu. Penjemputan dapat mengambil sampah maksimal 15kg',
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
                height: 250,
                margin: const EdgeInsets.all(10),
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
                                  return ItemWidget(
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
                      TextFormField(
                        controller: _geolokasi,
                        decoration: const InputDecoration(
                            hintText: 'Geo Lokasi',
                            border: OutlineInputBorder(),
                            suffixIcon: Icon(Icons.location_on),
                            labelText: 'Geo Lokasi'),
                        onTap: () async {
                          await Navigator.push(context, MaterialPageRoute(
                            builder: (context) {
                              return const MapPage();
                            },
                          ));
                          SharedBio.readPrefDouble('latitude').then((value) {
                            SharedBio.readPrefDouble('longitude')
                                .then((value2) {
                              setState(() {
                                latitude = value;
                                longitude = value2;
                                _geolokasi.text = '${latitude!}, ${longitude!}';
                              });
                              _alamatFocusNode.requestFocus();
                            });
                          });
                        },
                        validator: (value) {
                          if (value == null || value.isEmpty) {
                            return 'Alamat tidak boleh kosong';
                          }
                          return null;
                        },
                      ),
                      const SizedBox(height: 10),
                      TextFormField(
                        controller: _alamatpenjemputan,
                        focusNode: _alamatFocusNode,
                        decoration: const InputDecoration(
                            hintText: 'Alamat Penjemputan',
                            border: OutlineInputBorder(),
                            labelText: 'Alamat Penjemputan'),
                        validator: (value) {
                          if (value == null || value.isEmpty) {
                            return 'Alamat tidak boleh kosong';
                          }
                          return null;
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
                        enabled: false,
                        controller: _tanggalpenjemputan,
                        decoration: const InputDecoration(
                            hintText: 'Tanggal Penjemputan',
                            border: OutlineInputBorder(),
                            suffixIcon: Icon(Icons.calendar_today),
                            labelText: 'Tanggal Penjemputan'),
                        onTap: () {},
                        validator: (value) {
                          if (value == null || value.isEmpty) {
                            return 'Tanggal penjemputan tidak boleh kosong';
                          }
                          return null;
                        },
                      ),
                      const SizedBox(height: 10),
                      const Text('Waktu Penjemputan'),
                      DropdownButton(
                        value: _waktupenjemputan,
                        items: dropdownlist
                            .map((e) => DropdownMenuItem(
                                  value: e,
                                  child: Text(e),
                                ))
                            .toList(),
                        onChanged: (String? val) {
                          setState(() {
                            if (val != null) {
                              _waktupenjemputan = val;
                            }
                          });
                        },
                      ),
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
                                  if (_userImageFile!.path.isEmpty ||
                                      _alamatpenjemputan.text.isEmpty ||
                                      _nomortelepon.text.isEmpty ||
                                      _tanggalpenjemputan.text.isEmpty ||
                                      _waktupenjemputan.isEmpty ||
                                      latitude == null ||
                                      longitude == null ||
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
                                    customerid: widget.userid!,
                                    address: _alamatpenjemputan.text,
                                    nohp: _nomortelepon.text,
                                    datepickup: dateFormat.format(selectedDate),
                                    type: "pickup",
                                    latitude: latitude!,
                                    longitude: longitude!,
                                    time: _waktupenjemputan,
                                    catatan: _catatan.text,
                                    weight: _berattotal.toInt(),
                                    status: 'pending',
                                  );

                                  Navigator.push(
                                    context,
                                    MaterialPageRoute(
                                      builder: (context) => CheckoutPage(
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
