<html>
    <head>
        <title>Registration Form Under Process</title>
        <script type="text/javascript" src="js/validation.js"></script>
        <script type="text/javascript">
            function go_back()
            {
                self.location = 'login.php';
            }
        </script>
    </head>
<body>
<form name='registration-form' method='POST' action='includes/register-processing.php' autocomplete="off" onsubmit="return validateregister();">
    <table>
        <tr>
            <th colspan="2">Registration Form</th>
        </tr>   
        <tr>
            <td>Name *</td>
            <td><input type ='text' name ='name'/> </td>
        </tr>
        <tr>
            <td>Email-ID *</td>
            <td><input type ='text' name ='email'/></td>
        </tr>
        <tr>
            <td>Username *</td>
            <td><input type ='text' name ='username'/></td> 
        </tr>
        <tr>
            <td>Password *</td>
            <td><input type ='password' name ='password'/> </td>
        </tr>
        <tr> 
            <td>Confirm Password *</td>
            <td><input type ='password' name ='confirmpassword'/></td>
        </tr>
        <tr>
            <td><input type ='submit' name ='btnsubmit' value ='Submit' /> 
                <input type ='reset' name ='btnreset' value ='Clear'/>
                <input type='button' name="back" id="back" value="Back" onclick="go_back()"/>
            </td>
        </tr>

    </table> 
</form>
</body>
</html>
