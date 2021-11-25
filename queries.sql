-- GET PERSONAL DETAILS
SELECT * FROM stud WHERE sid = "166296";

-- GET COURSE DETAILS
SELECT enrl.pid, paward, ptitle, did, length FROM enrl, prog WHERE enrl.pid=prog.pid AND sid=166296 GROUP BY pid;

-- GET ENROLMENT AND PROGRESS DETAILS AND COURSE TITLE
SELECT * FROM enrl, stud, prog WHERE enrl.sid = stud.sid AND enrl.pid = prog.pid AND enrl.sid = 166296;

-- GET MODULE SELECTION DETAILS
