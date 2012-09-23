A-B-Split-Test-Server
=====================

This is a simple PHP Server to provide data for and store results from the iOS A/B Split Test Library (https://github.com/chrismaddern/iOS-Split-A-B-Test-Library). 

It is very basic at the moment and allows configuration only by entering test cases directly in to the MySQL Database.

**Setup**

This should run on any PHP+MySQL Environment

Use the included <code>database_setup.sql</code> to set up the MySQL Database. You will need to create a user with permission to read/write this database.

Copy the files to a folder on your webserver.

Edit the DB_USER, DB_PASSWORD, DB_NAME variables in <code>functions.php</code>

Set the server_base_url value in <code>ABTestSettings.plist</code> in the iOS library to the URL of the folder the files are in.

Either leave the <code>application_token</code> the same in both the database and the client library or create a new Application (table <code>applications</code>) and then set the <code>application_token</code> in the plist file to match the token for your newly created Application.

**Making a test**

A test is created by creating a <code>test_cases</code> table record and series of <code>test_case_values</code> records with their <code>test_case_id</code> set to that of the newly created test case. The value of <code>token</code> in <code>test_cases</code> is the identifier that you use to set the test in the User Defined Values in Interface Builder - <code>testCase</code>.

The test case must have it's Application set to the current Application's id (<code>application_id</code> column).

Results will automatically be uploaded to the <code>test_case_responses</code> table as tests are conducted in the client.

**License**

This is licensed under the MIT License.

**Contribution**

Contribution is welcomed and encouraged! It would be great to create a web UI for configuring and visualising results but I'm not sure when I will have time.

If you have any difficulties in setup, please update this doc so that others won't have the same problem - the initial docs were very brief!