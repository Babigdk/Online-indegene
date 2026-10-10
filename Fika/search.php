<?php

use OnlineIndegene\Logger;
use OnlineIndegene\SearchQuery;

require_once __DIR__ . '/database_fika.php';
require_once __DIR__ . '/lib/SearchQuery.php';

if (isset($_POST['button'])) {
    $searchInput = $_POST['search'] ?? '';
    if (!is_string($searchInput)) {
        http_response_code(400);
        echo 'Please enter a valid search term.';
        return;
    }

    $search = trim($searchInput);
    $query = SearchQuery::forTerm($search);

    try {
        $firstNamePattern = $query['parameters'][0];
        $lastNamePattern = $query['parameters'][1];
        $statement = $mysqli->prepare($query['sql']);
        $statement->bind_param('ss', $firstNamePattern, $lastNamePattern);
        $statement->execute();
        $results = $statement->get_result();

        if ($results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $firstName = htmlspecialchars($row['first_name'], ENT_QUOTES, 'UTF-8');
                $lastName = htmlspecialchars($row['last_name'], ENT_QUOTES, 'UTF-8');
                $homeTown = htmlspecialchars($row['home_town'], ENT_QUOTES, 'UTF-8');
                $phoneNumber = htmlspecialchars($row['phone_number'], ENT_QUOTES, 'UTF-8');
                $contactAddress = htmlspecialchars($row['contact_address'], ENT_QUOTES, 'UTF-8');
                $email = htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8');
                $gender = htmlspecialchars($row['gender'], ENT_QUOTES, 'UTF-8');
                $image = htmlspecialchars($row['image'], ENT_QUOTES, 'UTF-8');
                $submissionDate = htmlspecialchars($row['submission_date'], ENT_QUOTES, 'UTF-8');

                echo "<table>
                    <tr style='background: green; color: white; font: 14px tahoma; text-align: left;'>
                        <th>FIRST NAME</th>
                        <th>LAST NAME</th>
                        <th>HOME TOWN</th>
                        <th>PHONE NUMBER</th>
                        <th>CONTACT ADDRESS</th>
                        <th>EMAIL</th>
                        <th>GENDER</th>
                        <th>IMAGE</th>
                        <th>SUBMISSION DATE</th>
                    </tr>
                    <tr>
                        <td>{$firstName}</td>
                        <td>{$lastName}</td>
                        <td>{$homeTown}</td>
                        <td>{$phoneNumber}</td>
                        <td>{$contactAddress}</td>
                        <td>{$email}</td>
                        <td>{$gender}</td>
                        <td><img src=\"{$image}\" width='100' height='100' alt='Indigene'></td>
                        <td>{$submissionDate}</td>
                    </tr>
                </table>";
            }
        } else {
            echo "No record found <br><br>";
        }

        $statement->close();
    } catch (mysqli_sql_exception $exception) {
        Logger::error('Search failed', $exception);
        http_response_code(500);
        echo 'The search could not be completed. Please try again later.';
    }
}
