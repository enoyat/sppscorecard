import 'dart:convert';

// ignore_for_file: public_member_api_docs, sort_constructors_first
class Transaction {
  final int? id;
  final int customerid;
  final String? address;
  final String nohp;
  final int? workerid;
  final int? dropzoneid;
  final String type;
  final int weight;
  final double? latitude;
  final double? longitude;
  final String? photo;
  final String? status;
  final String datepickup;
  final String time;
  final String? paymentmethod;
  final String? catatan;
  final String? name;
  Transaction({
    this.id,
    required this.customerid,
    this.address,
    required this.nohp,
    this.workerid,
    this.dropzoneid,
    required this.type,
    required this.weight,
    this.latitude,
    this.longitude,
    this.photo,
    this.status,
    required this.datepickup,
    required this.time,
    this.paymentmethod,
    this.catatan,
    this.name,
  });

  Map<String, dynamic> toMap() {
    return <String, dynamic>{
      'id': id,
      'customerid': customerid,
      'address': address,
      'nohp': nohp,
      'workerid': workerid,
      'dropzoneid': dropzoneid,
      'type': type,
      'weight': weight,
      'latitude': latitude,
      'longitude': longitude,
      'photo': photo,
      'status': status,
      'datepickup': datepickup,
      'time': time,
      'paymentmethod': paymentmethod,
      'catatan': catatan,
      'name': name,
    };
  }

  factory Transaction.fromMap(Map<String, dynamic> map) {
    return Transaction(
      id: map['id'] != null ? map['id'] as int : null,
      customerid: map['customerid'] as int,
      address: map['address'] != null ? map['address'] as String : null,
      nohp: map['nohp'] as String,
      workerid: map['workerid'] != null ? map['workerid'] as int : null,
      dropzoneid: map['dropzoneid'] != null ? map['dropzoneid'] as int : null,
      type: map['type'] as String,
      weight: map['weight'] as int,
      latitude: map['latitude'] != null ? map['latitude'] as double : null,
      longitude: map['longitude'] != null ? map['longitude'] as double : null,
      photo: map['photo'] != null ? map['photo'] as String : null,
      status: map['status'] != null ? map['status'] as String : null,
      datepickup: map['datepickup'] as String,
      time: map['time'] as String,
      paymentmethod:
          map['paymentmethod'] != null ? map['paymentmethod'] as String : null,
      catatan: map['catatan'] != null ? map['catatan'] as String : null,
      name: map['name'] != null ? map['name'] as String : null,
    );
  }

  String toJson() => json.encode(toMap());

  factory Transaction.fromJson(String source) =>
      Transaction.fromMap(json.decode(source) as Map<String, dynamic>);

  Transaction copyWith({
    int? id,
    int? customerid,
    String? address,
    String? nohp,
    int? workerid,
    int? dropzoneid,
    String? type,
    int? weight,
    double? latitude,
    double? longitude,
    String? photo,
    String? status,
    String? datepickup,
    String? time,
    String? paymentmethod,
    String? catatan,
    String? name,
  }) {
    return Transaction(
      id: id ?? this.id,
      customerid: customerid ?? this.customerid,
      address: address ?? this.address,
      nohp: nohp ?? this.nohp,
      workerid: workerid ?? this.workerid,
      dropzoneid: dropzoneid ?? this.dropzoneid,
      type: type ?? this.type,
      weight: weight ?? this.weight,
      latitude: latitude ?? this.latitude,
      longitude: longitude ?? this.longitude,
      photo: photo ?? this.photo,
      status: status ?? this.status,
      datepickup: datepickup ?? this.datepickup,
      time: time ?? this.time,
      paymentmethod: paymentmethod ?? this.paymentmethod,
      catatan: catatan ?? this.catatan,
      name: name ?? this.name,
    );
  }

  @override
  String toString() {
    return 'Transaction(id: $id, customerid: $customerid, address: $address, nohp: $nohp, workerid: $workerid, dropzoneid: $dropzoneid, type: $type, weight: $weight, latitude: $latitude, longitude: $longitude, photo: $photo, status: $status, datepickup: $datepickup, time: $time, paymentmethod: $paymentmethod, catatan: $catatan, name: $name)';
  }
}
