// ignore_for_file: public_member_api_docs, sort_constructors_first
import 'package:flutter/material.dart';

import 'package:google_map/models/trouble.dart';
import 'package:google_map/pages/mekanik/formtrouble_page.dart';

class ItemTroubleWidget extends StatefulWidget {
  const ItemTroubleWidget({
    Key? key,
    required this.trouble,
    required this.handleRefresh,
  }) : super(key: key);
  final Trouble trouble;
  final Function handleRefresh;

  @override
  State<ItemTroubleWidget> createState() => _ItemTroubleWidgetState();
}

class _ItemTroubleWidgetState extends State<ItemTroubleWidget> {
  @override
  void initState() {
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return Card(
      child: Row(
        crossAxisAlignment: CrossAxisAlignment.start,
        mainAxisAlignment: MainAxisAlignment.spaceBetween,
        children: [
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                ListTile(
                  leading: const Icon(Icons.departure_board, size: 30),
                  title: Text(
                    "${widget.trouble.issue} ",
                  ),
                  trailing: Column(
                    children: [
                      Text(
                        widget.trouble.kdunit,
                        style: TextStyle(
                            color: widget.trouble.statusspp == 'OPEN'
                                ? Colors.red
                                : Colors.green),
                      ),
                      Text(
                        widget.trouble.statusspp!,
                        style: TextStyle(
                            color: widget.trouble.statusspp == 'OPEN'
                                ? Colors.red
                                : Colors.green),
                      ),
                    ],
                  ),
                  subtitle: Text(
                      'Target Completion Date: ${widget.trouble.targetcompletedate!}'),
                ),
                const Divider(),
                Row(
                  mainAxisAlignment: MainAxisAlignment.end,
                  children: [
                    widget.trouble.statusmekanik == 'OPEN'
                        ? Text(
                            'Mekanik Status: ${widget.trouble.statusmekanik!}',
                            style: const TextStyle(color: Colors.red))
                        : Text(
                            'Mekanik Status: ${widget.trouble.statusmekanik!}',
                            style: const TextStyle(color: Colors.green)),
                    TextButton.icon(
                      onPressed: () {
                        Navigator.push(context,
                            MaterialPageRoute(builder: (context) {
                          return FormTroublePage(idtrouble: widget.trouble.id);
                        }));
                      },
                      icon: const Icon(Icons.adjust),
                      label: const Text("Action"),
                    )
                  ],
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }
}
