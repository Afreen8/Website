<?php
session_start();
//print_r($_SESSION);
if ($_SESSION['user_login'] != null) {
    include_once('header.php');
    //include_once('menu.php');
    include_once('includes/website-processing.php');
?>
<script type="text/javascript">
function goto()
{
    self.location = 'login.php';
}
</script>
<body>
<div id="dialog-form" title="Create new Website">
    <p class="validateTips">All form fields are required.</p>
    <form id="newwebsite">
    <fieldset>
        <label for="name">Website Name</label>
        <input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all" />
    </fieldset>
    </form>
</div>
<div id="websites-contain" class="ui-widget">
    <h1>Existing Websites:</h1>
    <table id="websites" class="ui-widget ui-widget-content">
        <thead>
            <tr class="ui-widget-header ">
                <th colspan='2'>Name</th>
            </tr>
        </thead>
        <tbody>
            <?php
                getuserwebsites();
            ?>
        </tbody>
    </table>
</div>
<button id="create-website">Create new website</button>
<input type="button" name="back" id="back" value="Go Back" onclick="goto()"/>
</body>
<?php
include_once ('footer.php'); }
else {
    header('Location: ./login.php');
}
?>