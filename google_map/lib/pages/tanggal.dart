import 'package:flutter/material.dart';

class Tanggal extends StatefulWidget {
  const Tanggal({super.key});

  @override
  State<Tanggal> createState() => _TanggalState();
}

class _TanggalState extends State<Tanggal> {
  late DateTime selectedDate;

  void _pilihDate(BuildContext context) async {
    final DateTime? date = await showDatePicker(
      context: context,
      initialDate: selectedDate,
      firstDate: DateTime(2021),
      lastDate: DateTime(2040),
    );
    if (date != null && date != selectedDate) {
      setState(() {
        selectedDate = date;
      });
    }
  }

  @override
  void initState() {
    selectedDate = DateTime.now();
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Center(
        child: ElevatedButton(
          onPressed: () {
            _pilihDate(context);
          },
          child: const Text('Pilih Tanggal'),
        ),
      ),
    );
  }
}
