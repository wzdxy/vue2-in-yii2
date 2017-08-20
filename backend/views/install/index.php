<main class="row">
    <div class="col-md-4 col-md-offset-4">
        <h1>Install</h1>
        <form action="/install/init" method="post">
            <div class="form-group ">
                <label for="dbName">Database Name</label>
                <input name="dbName" class="form-control" type="text">
            </div>

            <div class="form-group ">
                <label for="dbUser">DB User Name</label>
                <input name="dbUser" class="form-control" type="text" value="">
            </div>

            <div class="form-group ">
                <label for="dbPassword">DB Password</label>
                <input name="dbPassword" class="form-control" type="password" value="">
            </div>

            <div class="form-group ">
                <label for="dbPrefix">DB Prefix</label>
                <input name="dbPrefix" class="form-control" type="text" value="">
            </div>

            <div class="form-group ">
                <label for="adminDomain">Admin backend Domain</label>
                <input name="adminDomain" class="form-control" type="text" value="">
            </div>

            <div class="form-group ">
                <label for="frontDomain">Blog frontend Domain</label>
                <input name="frontDomain" class="form-control" type="text" value="">
            </div>

            <div class="form-group ">
                <input type="submit" class="btn  btn-primary form-control">
            </div>

        </form>
    </div>

</main>
