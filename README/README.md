# PMS — Simple README for Submission

**Author:** nipun
**Project:** Patient Management System (PMS)

---

## 1) What I did (short)
I ran the app locally and tested the main features: **login**, **add patient**, **logout**, and checked the dashboard and appointments. Everything worked on my setup.

---

## 2) How to run (super simple)
1. Install XAMPP (or MAMP/WAMP) to get PHP + MySQL.
2. Put the project folder in your webserver folder (e.g. `C:\xampp\htdocs\PMS` or `/opt/lampp/htdocs/PMS`).
3. Start Apache and MySQL in XAMPP.
4. Open phpMyAdmin at `http://localhost/phpmyadmin` and import the SQL file if needed.
   - Create DB name `psm_db1` (or the name you prefer) and import `psm_db1.sql` if you have it.
5. Open the app: `http://localhost/PMS`
6. Try login → add patient → logout.

> Tip: If you see DB connection errors, open `PMS/db.php` and make sure the DB name, user and password match what you imported.

---

## 3) What I tested
- Login: works
- Add patient: creates new patient visible in UI
- Logout: ends session
- Dashboard & appointments: pages load and show data


## 3) Testing for different user roles (simple & clear)

### Patient role (what I tested / what to test)
- Patient signup/registration (if available): fill form → submit → expect success and new patient in list/DB.  
- Patient login: log in as patient → expect to see personal details and upcoming appointments.  
- Book/view appointments: make or view appointment → expect appointment saved and visible.  
- View treatment notes/history: open profile → expect past treatments/notes visible.  
- Logout: log out and confirm session ends.


### Doctor role (what I tested / what to test)
- Doctor login: log in as doctor → expect doctor dashboard (appointments, patient list).  
- View today's appointments: open appointments page for doctor → expect list of assigned appointments.  
- Record attendance / mark seen: mark appointment as attended → expect DB updated.  
- Add treatment notes: open appointment → add notes → expect notes saved to patient history.  
- Search patient records: search by name/ID → expect correct record to appear.  
- Logout: log out and confirm session ends.


## 4) What I tested (summary)
- Login (admin/doctor/patient as applicable): works  
- Add patient (admin or patient signup): creates new patient visible in UI  
- Patient view: patient can see their appointments/profile  
- Doctor view & actions: doctor can see appointments, mark attendance, add treatment notes  
- Logout: ends session for all roles  
- Dashboard & appointments: pages load and show data

