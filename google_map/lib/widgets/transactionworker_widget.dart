// ignore_for_file: pTransactionWorkerWidgetublic_member_api_docs, sort_constructors_first
import 'package:flutter/material.dart';
import 'package:google_map/models/transaction.dart';

import '../pages/worker/detail_transaction.dart';

class TransactionWorkerWidget extends StatefulWidget {
  const TransactionWorkerWidget({
    Key? key,
    required this.transaction,
    required this.handleRefresh,
  }) : super(key: key);
  final Transaction transaction;
  final Function handleRefresh;

  @override
  State<TransactionWorkerWidget> createState() =>
      _TransactionWorkerWidgetState();
}

class _TransactionWorkerWidgetState extends State<TransactionWorkerWidget> {
  String? status;
  String? pesan;

  @override
  void initState() {
    super.initState();
    if (widget.transaction.status == "pending") {
      status =
          "Kami Sedang Meninjau permintaan Pickup Kamu. Silakan Menunggu Maksimal 1x24 Jam untuk Proses Selanjutnya";
    } else if (widget.transaction.status == "confirm") {
      status =
          "Telah terkonfirmasi oleh Admin, Silakan untuk melakukan upload/foto bukti transaksi yang diberikan oleh kasir pengepul/penjemput sampah kamu";
    } else if (widget.transaction.status == "process") {
      status =
          "Terima Kasih, Bukti transaksi telah Kamu terima, untuk proses selanjutnya silakan menunggu proses dari Admin 1x24 jam";
    } else if (widget.transaction.status == "done") {
      status =
          "Terima Kasih. Verifikasi dari admin telah selesai, untuk proses mendapatkan Point/Penukaran Tunai, Kamu akan dihubungi oleh Nomor WA Resmi Admin di : 08xxxx";
    }
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
                  leading: const Icon(Icons.departure_board, size: 50),
                  title: Text(
                    "${widget.transaction.datepickup} - ${widget.transaction.type}",
                  ),
                  subtitle: Text(status.toString()),
                ),
                const Divider(),
                Row(
                  mainAxisAlignment: MainAxisAlignment.end,
                  children: [
                    TextButton.icon(
                      onPressed: () {
                        Navigator.push(context,
                            MaterialPageRoute(builder: (context) {
                          return DetailTransactionWorker(
                              id: widget.transaction.id);
                        }));
                      },
                      icon: const Icon(Icons.adjust),
                      label: const Text("Detail"),
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
