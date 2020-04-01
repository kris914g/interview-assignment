# Job interview assignment
We kindly ask you to solve the task below. By solving and submitting this assignment you provide us with insights in how you solve real-world problems. What we will be looking at are topics such as: choice of technology, structuring of code, use of VCS, selection of 3rd party libraries, documentation etc.

## The task
Develop a solution that, given a select query, can read data from a database, write it to a local file and then delete the data from the database. The solution should verify that data is written to the file, and that data integrity is maintained, before deleting it from the database.

- Use Bash, PHP, JavaScript or Go as the language
- Use MySQL, MariaDB, CockroachDB or SQLite as the database

Please use the data set provided in the SQL dump in this repo. Please also consider that your solution should be able to handle much larger data sets.

## Expectations
Make a copy of this repo. Solve the task below. Push your code to a public repo, and send us the link as a reply to our email.

Your solution should include a short readme describing your solution, how to use/test it and any final considerations such as known errors, next steps, security concerns etc. Don’t worry we are not expecting this thing to be perfect.

# Assignment answer
The program can be executed by entering the following command:

`php Main.php`

It is assumed that the data is already stored in the database before the program is executed. The program uses PDO (PHP Data Object) to connect to the database. 
The result of the query is encoded into JSON and stored in the `data.json` file. The data file would be read and stored into a string, and decoded back into an array. 

To verify the data integrity of the `data.json`file, the decoded array from `data.json` is compared against the result of the query.

The users which are verified will get their ids pushed to a new array, where the array of ids will be composed to a single string. The string will be used in the delete query, which ensures that it is only necessary with one query to delete the verified users.

At last, the PDO object gets assigned null, to delete all references. 

## Final considerations
One of the last considerations for the solution, could certainly be optimization of two foreach loops from line 38-44. which is not particularly effective on larger data sets, since it has the time complexity of `O(N^2)` which is not great for lager data sets. 
However this could be fixed with the php function `array_intersect()`. This could be implemented if the arrays had the same array structure.