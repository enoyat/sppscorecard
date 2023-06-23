// ignore_for_file: public_member_api_docs, sort_constructors_first
import 'dart:convert';

class Invoice {
  final int? id;
  final int? transactionid;
  final String image;
  final String status;
  Invoice({
    this.id,
    this.transactionid,
    required this.image,
    required this.status,
  });

  Map<String, dynamic> toMap() {
    return <String, dynamic>{
      'id': id,
      'transactionid': transactionid,
      'image': image,
      'status': status,
    };
  }

  factory Invoice.fromMap(Map<String, dynamic> map) {
    return Invoice(
      id: map['id'] != null ? map['id'] as int : null,
      transactionid:
          map['transactionid'] != null ? map['transactionid'] as int : null,
      image: map['image'] as String,
      status: map['status'] as String,
    );
  }

  String toJson() => json.encode(toMap());

  factory Invoice.fromJson(String source) =>
      Invoice.fromMap(json.decode(source) as Map<String, dynamic>);

  Invoice copyWith({
    int? id,
    int? transactionid,
    String? image,
    String? status,
  }) {
    return Invoice(
      id: id ?? this.id,
      transactionid: transactionid ?? this.transactionid,
      image: image ?? this.image,
      status: status ?? this.status,
    );
  }

  @override
  String toString() {
    return 'Invoice(id: $id, transactionid: $transactionid, image: $image, status: $status)';
  }
}
