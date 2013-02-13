<html>
    <head>
        <title>User Login Form</title>
        <script src="js/validation.js"></script>
        <script type="text/javascript">
        function goto_page()
        {    
            self.location = 'register.php';
        }
        </script>
    </head>
    <body>
        <form name='login-form' method='POST' action='includes/chk_login.php' autocomplete="off">
            <table>
                <tr>
                    <td colspan="2"><b>Login Form</b></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type ='text' name ='username' autofocus /> </td>
                </tr>
                <tr>
                    <td>Password </td>
                    <td><input type ='password' name ='password'/> </td>
                </tr>
                <tr> 
                    <td colspan="2">
                        <input type ='submit' name ='btnsubmit' value ='Submit' onclick="return validatelogin()" /> 
                        <input type ='reset' name ='btnreset' value ='Clear' />
                        <input type='button' name='btn' value='Register' onclick="goto_page();"/>
                    </td>
                
                </tr>
            </table>
            
        </form>
    </body>
</html>