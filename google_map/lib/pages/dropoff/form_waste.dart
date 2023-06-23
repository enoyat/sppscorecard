// ignore_for_file: public_member_api_docs, sort_constructors_first
import 'package:flutter/material.dart';

import 'package:google_map/models/cart_wastetype.dart';
import 'package:google_map/models/subcart.dart';
import 'package:google_map/pages/dropoff/dropoff_page.dart';
import 'package:google_map/services/cart_dio.dart';

import '../../models/cart.dart';
import '../../models/cart_wastesubtype.dart';

class FormWastePageDrop extends StatefulWidget {
  const FormWastePageDrop({
    Key? key,
    required this.cart,
    required this.isAction,
    required this.userid,
  }) : super(key: key);
  final Cart cart;
  final bool isAction;
  final int userid;

  @override
  State<FormWastePageDrop> createState() => _FormWastePageDrop();
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

class _FormWastePageDrop extends State<FormWastePageDrop> {
  List<MyClass> selecteditems = [];
  final List<Cart> _cart = [];

  List<Map<String, dynamic>> _listsubwastetype = [];
  List<Map<String, dynamic>> _dataharga = [];
  List<CartWasteSubType> _cartwastesubtype = [];
  int id = 0;
  final berat = TextEditingController();

  bool isLoading = false;
  int addsCount = 1;
  int hargamin = 0;
  int hargamax = 0;

  void minmax() {
    _dataharga = List.generate(
        _cartwastesubtype.length,
        (index) => {
              'id': _cartwastesubtype[index].id,
              'harga': _cartwastesubtype[index].harga,
            });

    if (_cartwastesubtype.isNotEmpty) {
      for (var i = 0; i < _dataharga.length; i++) {
        if (_dataharga[i]['harga'] == null) {
          _dataharga.removeAt(i);
        }
      }
      _dataharga.sort((a, b) => a["harga"].compareTo(b["harga"]));
    }
    setState(() {
      hargamin = _dataharga.first['harga'];
      hargamax = _dataharga.last['harga'];
    });
  }

  void refreshData() async {
    setState(() {
      isLoading = true;
    });
    CartDio().getSubCart(widget.userid, id).then((value) {
      setState(() {
        _cartwastesubtype = value;
        _listsubwastetype = List.generate(
            _cartwastesubtype.length,
            (index) => {
                  'id': _cartwastesubtype[index].id,
                  'name': _cartwastesubtype[index].name,
                  'value':
                      _cartwastesubtype[index].incartid == null ? false : true,
                });
        isLoading = false;
        minmax();
      });
    });
  }

  @override
  void initState() {
    super.initState();
    _cart.add(widget.cart);
    id = _cart[0].id;
    (_cart[0].berat != null)
        ? berat.text = _cart[0].berat.toString()
        : berat.text = "0";
    refreshData();
  }

  @override
  Widget build(BuildContext context) {
    final size = MediaQuery.of(context).size;
    return Container(
      decoration: const BoxDecoration(
        image: DecorationImage(
          image: AssetImage("assets/images/background.png"),
          fit: BoxFit.cover,
        ),
      ),
      child: Scaffold(
        body: Column(
          children: [
            const SizedBox(height: 40),
            Container(
              height: 50,
              color: Colors.orange,
              width: size.width,
              margin: const EdgeInsets.only(top: 5, left: 10, right: 10),
              child: Align(
                alignment: Alignment.center,
                child: Row(
                  children: [
                    SizedBox(
                      width: 50,
                      child: IconButton(
                        onPressed: () {
                          Navigator.pop(context);
                        },
                        icon: const Icon(Icons.arrow_circle_left_outlined),
                      ),
                    ),
                    const Align(
                      alignment: Alignment.center,
                      child: Text(
                        'Jenis Sampah',
                        style: TextStyle(
                            fontSize: 20,
                            fontWeight: FontWeight.bold,
                            color: Colors.white),
                        textAlign: TextAlign.center,
                      ),
                    ),
                  ],
                ),
              ),
            ),
            Container(
              padding: const EdgeInsets.all(10),
              height: 100,
              child: GridView.count(
                shrinkWrap: true,
                crossAxisCount: 2,
                children: [
                  SizedBox(
                    child: Column(
                      children: [
                        const Text('Jenis Sampah:'),
                        Text(
                          _cart[0].name,
                          style: const TextStyle(
                              fontSize: 15, fontWeight: FontWeight.bold),
                          textAlign: TextAlign.center,
                        ),
                      ],
                    ),
                  ),
                  SizedBox(
                    child: TextField(
                      controller: berat,
                      keyboardType: TextInputType.number,
                      textDirection: TextDirection.rtl,
                      style: const TextStyle(
                          color: Color.fromARGB(255, 124, 6, 6), fontSize: 12),
                      decoration: const InputDecoration(
                        border: OutlineInputBorder(),
                        labelStyle: TextStyle(color: Colors.white),
                        prefix: Text('Perkiraan Berat: '),
                        suffix: Text('kg'),
                      ),
                      onChanged: (value) {},
                    ),
                  ),
                ],
              ),
            ),
            const Text('Sub Jenis Sampah', style: TextStyle(fontSize: 15)),
            Expanded(
              child: ListView(
                children: [
                  Container(
                    padding: const EdgeInsets.only(bottom: 0),
                    height: size.height * 0.55,
                    child: isLoading
                        ? const Center(
                            child: CircularProgressIndicator(),
                          )
                        : _cartwastesubtype.isEmpty
                            ? const Center(
                                child: Text('Tidak ada Item'),
                              )
                            : ListView.builder(
                                itemCount: _cartwastesubtype.length,
                                itemBuilder: (context, index) {
                                  return Container(
                                    margin: const EdgeInsets.all(10),
                                    decoration: BoxDecoration(
                                      border: Border.all(
                                          color: const Color.fromARGB(
                                              255, 194, 192, 192),
                                          width: 1),
                                    ),
                                    child: CheckboxListTile(
                                      title: Text(_listsubwastetype[index]
                                              ['name']
                                          .toString()),
                                      value: _listsubwastetype[index]['value'],
                                      onChanged: (value) {
                                        setState(() {
                                          _listsubwastetype[index]['value'] =
                                              value;
                                        });
                                      },
                                    ),
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
              decoration:
                  const BoxDecoration(color: Color.fromARGB(255, 250, 115, 5)),
              child: Row(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                children: [
                  Column(
                    children: [
                      const Text(
                        'Estimasi Harga / Kg :',
                        style: TextStyle(color: Colors.white),
                      ),
                      Text(
                        'Rp : $hargamin - Rp. $hargamax',
                        style: const TextStyle(color: Colors.white),
                      ),
                    ],
                  ),
                  Directionality(
                    textDirection: TextDirection.rtl,
                    child: TextButton.icon(
                        onPressed: () async {
                          final CartWasteType item = CartWasteType(
                            wastetypeid: id,
                            berat: int.parse(berat.text),
                            userid: widget.userid,
                            hargamin: hargamin,
                            hargamax: hargamax,
                            status: "1",
                          );
                          //kosongkan subcart
                          var itemhapus = {};
                          itemhapus["userid"] = widget.userid;
                          itemhapus["wastetypeid"] = id;

                          await CartDio().hapussubcart(itemhapus);

                          for (int i = 0; i < _listsubwastetype.length; i++) {
                            if (_listsubwastetype[i]['value'] == true) {
                              final SubCart itemsubcart = SubCart(
                                userid: widget.userid,
                                wastetypeid: id,
                                wastesubtypeid: _listsubwastetype[i]['id'],
                              );
                              await CartDio().subcartstore(itemsubcart);
                            }
                          }

                          if (widget.isAction == true) {
                            CartDio().postData(item);
                            if (!mounted) return;
                            Navigator.push(context, MaterialPageRoute(
                              builder: (context) {
                                return DropoffPage(userid: widget.userid);
                              },
                            ));
                          } else {
                            final CartWasteType item = CartWasteType(
                              id: _cart[0].idcart,
                              wastetypeid: id,
                              berat: int.parse(berat.text),
                              userid: widget.userid,
                              hargamin: hargamin,
                              hargamax: hargamax,
                              status: "1",
                            );
                            CartDio().updateData(item);
                            if (!mounted) return;
                            Navigator.push(context, MaterialPageRoute(
                              builder: (context) {
                                return DropoffPage(userid: widget.userid);
                              },
                            ));
                          }
                        },
                        icon: const Icon(
                          Icons.fast_forward,
                          color: Colors.white,
                        ),
                        label: const Text(
                          'Selanjutnya',
                          style: TextStyle(color: Colors.white),
                        )),
                  ),
                ],
              ),
            )
          ],
        ),
      ),
    );
  }
}
