-- GET PERSONAL DETAILS
SELECT * FROM stud WHERE sid = "166296";

-- GET COURSE DETAILS
SELECT enrl.pid, paward, ptitle, prog.did, length, dname FROM enrl, prog, dept WHERE enrl.pid=prog.pid AND prog.did=dept.did AND sid=166296 GROUP BY pid ORDER BY lvl DESC;

-- GET ENROLMENT AND PROGRESS DETAILS AND COURSE TITLE
SELECT * FROM enrl, stud, prog WHERE enrl.sid = stud.sid AND enrl.pid = prog.pid AND enrl.sid = 166296 ORDER BY lvl DESC;

-- GET MODULE SELECTION DETAILS
SELECT smod.ayr, smod.mid, mtitle, credits
FROM enrl, smod, mods
WHERE enrl.ayr = smod.ayr AND enrl.sid = smod.sid AND
smod.mid = mods.mid AND enrl.sid = 166296
ORDER BY smod.ayr desc;

-- MODULE SELECTION DETAILS IN IMPROVED ORDER
SELECT smod.ayr, smod.mid, mtitle, credits
FROM enrl, smod, mods
WHERE enrl.ayr = smod.ayr AND enrl.sid = smod.sid AND
smod.mid = mods.mid AND enrl.sid = 166296
ORDER BY smod.ayr desc, smod.mid desc;