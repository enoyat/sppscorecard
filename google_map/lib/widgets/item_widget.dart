// ignore_for_file: public_member_api_docs, sort_constructors_first
import 'package:flutter/material.dart';

import 'package:google_map/services/cart_dio.dart';

import '../models/cart.dart';
import '../pages/form_waste.dart';

class ItemWidget extends StatelessWidget {
  const ItemWidget({
    Key? key,
    required this.cart,
    required this.userid,
    required this.handleRefresh,
  }) : super(key: key);
  final Cart cart;
  final int userid;
  final Function handleRefresh;

  @override
  Widget build(BuildContext context) {
    return Card(
      shape: RoundedRectangleBorder(
        borderRadius: BorderRadius.circular(10.0),
        side: const BorderSide(
            color: Color.fromARGB(255, 248, 91, 0), width: 0.5),
      ),
      elevation: 2,
      child: Row(
        crossAxisAlignment: CrossAxisAlignment.start,
        mainAxisAlignment: MainAxisAlignment.spaceBetween,
        children: [
          Expanded(
            child: Container(
              padding: const EdgeInsets.all(10),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Padding(
                    padding: const EdgeInsets.all(8.0),
                    child: Text(cart.name,
                        style: const TextStyle(
                            fontSize: 15, fontWeight: FontWeight.bold)),
                  ),
                ],
              ),
            ),
          ),
          if (cart.idcart == null)
            Container(
              margin: const EdgeInsets.only(right: 10),
              child: ElevatedButton(
                style: ElevatedButton.styleFrom(
                  backgroundColor: const Color.fromARGB(255, 248, 91, 0),
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(10.0),
                  ),
                ),
                onPressed: () async {
                  Navigator.push(context, MaterialPageRoute(builder: (context) {
                    return FormWastePage(
                      isAction: true,
                      cart: cart,
                      userid: userid,
                    );
                  }));
                },
                child: const Text('pilih'),
              ),
            ),
          if (cart.idcart != null)
            Row(
              children: [
                IconButton(
                    onPressed: () async {
                      CartDio().deleteData(cart).then((value) {
                        handleRefresh();
                      });
                    },
                    icon: const Icon(
                      Icons.delete,
                      size: 15,
                      color: Colors.red,
                    )),
                Text("${cart.berat} Kg",
                    style: const TextStyle(
                        fontSize: 13, fontWeight: FontWeight.bold)),
                IconButton(
                    onPressed: () async {
                      Navigator.push(context,
                          MaterialPageRoute(builder: (context) {
                        return FormWastePage(
                          isAction: false,
                          cart: cart,
                          userid: userid,
                        );
                      }));
                    },
                    icon: const Icon(
                      Icons.edit,
                      size: 15,
                      color: Colors.blue,
                    )),
              ],
            ),
        ],
      ),
    );
  }
}
