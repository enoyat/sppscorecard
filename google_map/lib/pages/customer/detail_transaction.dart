// ignore_for_file: public_member_api_docs, sort_constructors_first
import 'package:flutter/material.dart';
import 'package:google_map/widgets/order_statuspending.dart';
import 'package:google_map/widgets/order_statusproses.dart';

import '../../models/transaction.dart';
import '../../services/transaction_dio.dart';
import '../../widgets/order_statusconfirm.dart';
import '../../widgets/order_statusdone.dart';

class DetailTransaction extends StatefulWidget {
  const DetailTransaction({
    Key? key,
    this.id,
  }) : super(key: key);
  final int? id;

  @override
  State<DetailTransaction> createState() => _DetailTransactionState();
}

class _DetailTransactionState extends State<DetailTransaction> {
  List<Transaction> _transaction = [];
  bool isLoading = false;
  String isProses = '';

  void refresh() async {
    setState(() {
      isLoading = true;
    });
    await TransactionDio().gettransaction(widget.id!).then((value) {
      setState(() {
        _transaction = value;
        isProses = _transaction[0].status.toString();
        isLoading = false;
      });
    });
  }

  @override
  void initState() {
    super.initState();
    if (widget.id != null) {
      refresh();
    }
  }

  myform(String status) {
    if (status == "pending") {
      return OrderStatusPending(
        transaction: _transaction[0],
      );
    } else if (status == "confirm") {
      return OrderStatusConfirm(
        transaction: _transaction[0],
      );
    } else if (status == "process") {
      return OrderStatusProses(
        transaction: _transaction[0],
      );
    } else if (status == "done") {
      return OrderStatusDone(
        transaction: _transaction[0],
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text("Detail Transaction"),
      ),
      body: Container(
          child: isLoading
              ? const Center(
                  child: CircularProgressIndicator(),
                )
              : myform(isProses.toString())),
    );
  }
}
