# App Backend
This is the backend and admin panel only for the Android App visit [here](https://github.com/suvambasak/GISBMS.git).

- The directory `services` contains backend web services for the app.
- The directory `admin` contains the admin panel.


## Deployment
1. Install git and XAMPP
2. Change ownership of the `htdocs` directory.
> $ sudo chmod -R user /opt/lampp/htdocs/
3. Change the directory to `htdocs` and clone the repository.
> $ cd /opt/lampp/htdocs/

> $ git clone https://github.com/suvambasak/gis-backend.git
4. Start apache and MySQL
> $ sudo /opt/lampp/lampp start
5. Goto: http://localhost/phpmyadmin/
6. Inside import tab import file `gisdb.sql`
7. Edit the source code and change the database credential (you may need to change some page redirect URL also).
8. Goto: http://localhost/admin/

## Admin panel
<br>
<p align='center' width='100%'>
    <img width='500' src='https://github.com/suvambasak/gis-backend/blob/master/doc/Login.png?raw=true'>
    &nbsp;&nbsp;&nbsp;
    <img width='500' src='https://github.com/suvambasak/gis-backend/blob/master/doc/MapView.png?raw=true'>
</p>
<br>
<p align='center' width='100%'>
    <img width='500' src='https://github.com/suvambasak/gis-backend/blob/master/doc/AdminControl.png?raw=true'>
    &nbsp;&nbsp;&nbsp;
    <img width='500' src='https://github.com/suvambasak/gis-backend/blob/master/doc/AddEmp.png?raw=true'>
</p>
<br>
<p align='center' width='100%'>
    <img width='500' src='https://github.com/suvambasak/gis-backend/blob/master/doc/RemoveEmp.png?raw=true'>
</p>