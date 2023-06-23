// ignore_for_file: public_member_api_docs, sort_constructors_first
import 'package:flutter/material.dart';

import '../models/itemcart.dart';
import '../models/itemsubcart.dart';
import '../services/cart_dio.dart';

class ItemCartWidget extends StatefulWidget {
  const ItemCartWidget({
    Key? key,
    required this.itemcart,
    required this.userid,
    required this.handleRefresh,
  }) : super(key: key);
  final ItemCart itemcart;
  final int userid;
  final Function handleRefresh;

  @override
  State<ItemCartWidget> createState() => _ItemCartWidgetState();
}

class _ItemCartWidgetState extends State<ItemCartWidget> {
  List<ItemSubCart> itemsubcart = [];

  void getitemsubcart() async {
    await CartDio()
        .itemsubcart(widget.userid, widget.itemcart.wastetypeid)
        .then((value) {
      setState(() {
        itemsubcart = value;
      });
    });
  }

  @override
  void initState() {
    super.initState();
    getitemsubcart();
  }

  @override
  Widget build(BuildContext context) {
    return Column(
      children: [
        Row(
          children: [
            Text(widget.itemcart.name!,
                style:
                    const TextStyle(fontSize: 11, fontWeight: FontWeight.bold)),
            const Text(" | "),
            Text("${widget.itemcart.berat} Kg",
                style:
                    const TextStyle(fontSize: 11, fontWeight: FontWeight.bold)),
            const Spacer(),
            Text(
                'Rp. ${widget.itemcart.hargamin.toString()} s.d Rp. ${widget.itemcart.hargamax.toString()}',
                style:
                    const TextStyle(fontSize: 11, fontWeight: FontWeight.bold)),
          ],
        ),
        Container(
          margin: const EdgeInsets.only(left: 10),
          child: ListView.builder(
              itemBuilder: itemsubcart.isEmpty
                  ? (context, index) => const Center(
                        child: CircularProgressIndicator(),
                      )
                  : (context, index) => Text(itemsubcart[index].name.toString(),
                      style: const TextStyle(fontSize: 11)),
              itemCount: itemsubcart.length,
              shrinkWrap: true,
              physics: const NeverScrollableScrollPhysics()),
        ),
      ],
    );
  }
}
