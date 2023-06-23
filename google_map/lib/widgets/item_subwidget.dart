// ignore_for_file: public_member_api_docs, sort_constructors_first
import 'package:flutter/material.dart';

import '../models/wastesubtype.dart';

class ItemSubWidget extends StatefulWidget {
  const ItemSubWidget({
    Key? key,
    required this.subwastetype,
  }) : super(key: key);
  final WasteSubType subwastetype;

  @override
  State<ItemSubWidget> createState() => _ItemSubWidgetState();
}

class _ItemSubWidgetState extends State<ItemSubWidget> {
  bool isChecked = false;
  

  @override
  void initState() {
    super.initState();
    isChecked = false;
  }

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
                  Row(
                    children: [
                      Padding(
                        padding: const EdgeInsets.all(8.0),
                        child: Text(widget.subwastetype.name,
                            style: const TextStyle(
                                fontSize: 15, fontWeight: FontWeight.bold)),
                      ),
                      Expanded(
                        child: Align(
                          alignment: Alignment.centerRight,
                          child: Checkbox(
                              value: isChecked,
                              onChanged: (value) {
                                setState(() {
                                  isChecked = value!;
                                });
                              }),
                        ),
                      )
                    ],
                  ),
                ],
              ),
            ),
          ),
        ],
      ),
    );
  }
}
