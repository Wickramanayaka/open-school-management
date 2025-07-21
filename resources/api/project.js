/**
 * @apiDefine TheGivenDataWasInvalid
 *
 * @apiError TheGivenDataWasInvalid The email or password is incorrect.
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 422 Unproccessable Entities
 *     {
 *       "message": "The given data was invalid.",
 *       "error": {
 *              "email": [
 *                      "These credentials do not match our records"
 *                  ]
 *          }
 *     }
 */

/**
 * @api {post} login Login
 * @apiName Login
 * @apiVersion 0.1.0
 * @apiGroup User
 *
 * @apiParam {Number} pin_code Users pin code.
 *
 * @apiSuccess {String} id ID of the User.
 * @apiSuccess {String} name  Name of the User.
 * @apiSuccess {String} email  Email of the User.
 * @apiSuccess {String} api_token  API Token of the User.
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *          "data": {
 *              "id": 1,
 *              "name": "Administrator",
 *              "email": "admin@bs.com",
 *              ...
 *              "api_token": "gSQB8eGiIWf6Uun8QmmHAQxryXEYJrWQ81HsfQRmomVc97BXVvqwlzSbf6a6"
 *          }
 *     }
 *
 * @apiUse TheGivenDataWasInvalid
 */

 /**
 * @api {post} logout Logout
 * @apiName Logout
 * @apiVersion 0.1.0
 * @apiGroup User
 *
 * @apiParam {String} api_token Users API token.
 *
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *          "data": "User logged out."
 *     }
 *
 */

 /**
 * @api {get} coverage/check?api_token= Check API
 * @apiName Check
 * @apiVersion 0.1.0
 * @apiGroup User
 *
 * @apiParam {String} api_token Users API token.
 *
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *          "data": [
 *              "message": "Okay"
 *          ]
 *     }
 *
 */

 /**
 * @api {post} coverage/class_room/subject Get Subject
 * @apiName GetSubjectForClassRoom
 * @apiVersion 0.1.0
 * @apiGroup User
 *
 * @apiParam {String} api_token Users API token.
 * @apiParam {Number} id Class Room id.
 *
 * @apiSuccess {String} id ID of the subject.
 * @apiSuccess {String} name  Name of the subject.
 * 
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *          "subject": [{
 *              "id": 1,
 *              "name": "Maths",
 *              "language": "Sinhala"              
 *          }]
 *     }
 *
 */

 /**
 * @api {post} coverage/class_room/student Get Student
 * @apiName GetStudentForClassRoom
 * @apiVersion 0.1.0
 * @apiGroup User
 *
 * @apiParam {String} api_token Users API token.
 * @apiParam {Number} id Class Room id.
 *
 * @apiSuccess {String} id ID of the student.
 * @apiSuccess {String} first_name  First name of the student.
 * @apiSuccess {String} surname  Surname of the student.
 * 
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *          "student": [{
 *              "id": 1,
 *              "first_name": "Peter",
 *              "surname": "David"          
 *          }]
 *     }
 *
 */

 /**
 * @api {post} coverage/subject/chapter Get Chapter
 * @apiName GetChapterForSubject
 * @apiVersion 0.1.0
 * @apiGroup User
 *
 * @apiParam {String} api_token Users API token.
 * @apiParam {Number} id Subject id.
 *
 * @apiSuccess {Number} id ID of the chapter.
 * @apiSuccess {Number} number  Number of the chapter.
 * @apiSuccess {String} name  Name of the chapter.
 * 
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *          "chapter": [{
 *              "id": 1,
 *              "number": "1",
 *              "name": "Basic calculus"          
 *          }]
 *     }
 *
 */

 /**
 * @api {post} coverage/class_room Get Class Room
 * @apiName GetClassRoom
 * @apiVersion 0.1.0
 * @apiGroup User
 *
 * @apiParam {String} api_token Users API token.
 *
 * @apiSuccess {Number} id ID of the class room.
 * @apiSuccess {String} name  Name of the class room.
 * 
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *          "chapter": [{
 *              "id": 1,
 *              "name": "1 A"          
 *          }]
 *     }
 *
 */

 /**
 * @api {post} coverage/class_room/register Marking Class Room Register
 * @apiName MarkingClassRoomRegister
 * @apiVersion 0.1.0
 * @apiGroup User
 *
 * @apiParam {String} api_token Users API token.
 * @apiParam {Number} teacher_id ID of the teacher.
 * @apiParam {Number} class_room_id ID of the class room.
 * @apiParam {Array} student_ids Array of student ids.
 *
 * @apiSuccess {String} message  Command success message.
 * 
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *          "message": {Registration has been done successfully.}
 *     }
 *
 */

 /**
 * @api {post} coverage/period/begin Period Begin
 * @apiName PeriodBegin
 * @apiVersion 0.1.0
 * @apiGroup User
 *
 * @apiParam {String} api_token Users API token.
 * @apiParam {Number} teacher_id ID of the teacher.
 * @apiParam {Number} class_room_id ID of the class room.
 * @apiParam {Number} chapter_id ID of the chapter.
 * @apiParam {Number} coverage Presentage of chapter coverage.
 *
 * @apiSuccess {Number} id  ID of the period.
 * 
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *          "period": {
 *              "id": 1,
 *              "subject": "Maths",
 *              "chapter": "Algibra",
 *              "date": "2018-05-23",
 *              "time_in": "09:30:00"
 *              "coverage" : 50
 *           }
 *     }
 *
 */

 /**
 * @api {post} coverage/period/complete Period Complete
 * @apiName PeriodComplete
 * @apiVersion 0.1.0
 * @apiGroup User
 *
 * @apiParam {String} api_token Users API token.
 * @apiParam {Number} period_id ID of the teacher.
 * @apiParam {Number} progress Progress of the chapter.
 *
 * @apiSuccess {String} message  Command success message.
 * 
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *          "message": {"Syllabus progress has been updated successfully."}
 *     }
 *
 */

 /**
 * @api {post} coverage/period/incomplete Period Incomplete
 * @apiName PeriodIncomplete
 * @apiVersion 0.1.0
 * @apiGroup User
 *
 * @apiParam {String} api_token Users API token.
 * @apiParam {Number} teacher_id ID of the teacher.
 * @apiParam {Number} class_room_id ID of the class room.
 *
 * @apiSuccess {Number} id  ID of the period.
 * @apiSuccess {String} subject  Name of the subject.
 * @apiSuccess {String} chapter  Name of the chapter.
 * @apiSuccess {Date} date The date of period begin.
 * @apiSuccess {Time} time_in The time of period begin.
 * @apiParam {Number} coverage Presentage of chapter coverage.
 * 
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *          "period": {
 *              "id": 1,
 *              "subject": "Maths",
 *              "chapter": "Algibra",
 *              "date": "2018-05-23",
 *              "time_in": "09:30:00"
 *              "coverage" : 50
 *           }
 *     }
 *
 */

 /**
 * @api {post} coverage/feedback Student Feedback
 * @apiName StudentFeedback
 * @apiVersion 0.1.0
 * @apiGroup User
 *
 * @apiParam {Number} admission_number Student admission numbern.
 * @apiParam {Number} period_id ID of the period.
 * @apiParam {Number} point Point for the teacher.
 * @apiParam {String} image Student photo.
 *
 * @apiSuccess {Number} id  ID of the feedback.
 * @apiSuccess {Number} student_id  ID of the student.
 * @apiSuccess {Number} teacher_id  ID of the teacher.
 * @apiSuccess {Number} period_id ID of the period.
 * @apiSuccess {Number} point Point for the teacher.
 * @apiSuccess {String} photo Photo of the student.
 * 
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *          "period": {
 *              "id": 1,
 *              "student_id": "1",
 *              "period_id": "1",
 *              "teacher_id": "5",
 *              "point": 100
 *              "photo" : "photo.jpg"
 *           }
 *     }
 *
 */

 /**
 * @api {post} coverage/class_room/info Class Room Information
 * @apiName ClassRoomInfo
 * @apiVersion 0.1.0
 * @apiGroup User
 *
 * @apiParam {String} api_token Users API token.
 * @apiParam {Number} class_room_id ID of the class room.
 *
 * @apiSuccess {String} class_room  Name of class room.
 * @apiSuccess {String} class_teacher  Class room teacher.
 * @apiSuccess {Number} total_student  Class room total students.
 * @apiSuccess {Number} absent_student  Class room absent students.
 * 
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *          "class_room": "1-A",
 *          "class_teacher": "David",
 *          "total_student": 20,
 *          "absent_student": 1
 *     }
 *
 */

/**
 * @api {post} coverage/feedback Student Feedback
 * @apiName StudentFeedback
 * @apiVersion 0.1.1
 * @apiGroup User
 *
 * @apiParam {Number} period_id ID of the period.
 * @apiParam {Number} point Point for the teacher.
 *
 * @apiSuccess {Number} id  ID of the feedback.
 * @apiSuccess {Number} student_id  ID of the student.
 * @apiSuccess {Number} teacher_id  ID of the teacher.
 * @apiSuccess {Number} period_id ID of the period.
 * @apiSuccess {Number} point Point for the teacher.
 * @apiSuccess {String} photo Photo of the student.
 * 
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *          "period": {
 *              "id": 1,
 *              "period_id": "1",
 *              "teacher_id": "5",
 *              "point": 100
 *           }
 *     }
 *
 */

 /**
 * @api {post} coverage/device Device Registration
 * @apiName DeviceRegistration
 * @apiVersion 0.1.0
 * @apiGroup User
 *
 * @apiParam {Number} class_room_id ID of the class_room.
 * @apiParam {Number} device_id ID of the device.
 *
 * @apiSuccess {String} message Message of device rgistration.
 * 
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *          "message": "The device has been registered successfully."
 *     }
 *
 */

 