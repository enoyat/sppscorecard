import 'dart:convert';

// ignore_for_file: public_member_api_docs, sort_constructors_first
class Chat {
  final int? id;
  final int userid;
  final String? username;
  final String type;
  final String message;
  final String status;
  Chat({
    this.id,
    required this.userid,
    this.username,
    required this.type,
    required this.message,
    required this.status,
  });

  Map<String, dynamic> toMap() {
    return <String, dynamic>{
      'id': id,
      'userid': userid,
      'username': username,
      'type': type,
      'message': message,
      'status': status,
    };
  }

  factory Chat.fromMap(Map<String, dynamic> map) {
    return Chat(
      id: map['id'] != null ? map['id'] as int : null,
      userid: map['userid'] as int,
      username: map['username'] != null ? map['username'] as String : null,
      type: map['type'] as String,
      message: map['message'] as String,
      status: map['status'] as String,
    );
  }

  String toJson() => json.encode(toMap());

  factory Chat.fromJson(String source) =>
      Chat.fromMap(json.decode(source) as Map<String, dynamic>);

  Chat copyWith({
    int? id,
    int? userid,
    String? username,
    String? type,
    String? message,
    String? status,
  }) {
    return Chat(
      id: id ?? this.id,
      userid: userid ?? this.userid,
      username: username ?? this.username,
      type: type ?? this.type,
      message: message ?? this.message,
      status: status ?? this.status,
    );
  }

  @override
  String toString() {
    return 'Chat(id: $id, userid: $userid, username: $username, type: $type, message: $message, status: $status)';
  }
}
