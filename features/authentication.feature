Feature: Membership
  In order to allow registered users to buy and sell products
  As an administrator
  I need user registration and login

  Scenario: New user registration
    Given I set header "Content-Type" with value "application/json"
    When I send a POST request to "api/v1/register" with values:
      | first_name | Hrishikesh |
      | last_name  | Sawant     |
      | email      | hris@ex.com|
      | password   | chocopie   |
      | password_confirmation | chocopie |
    Then the response code should be 201
    And the response should contain json:
      """
      {
        "message": "Account created successfully"
      }
      """

  Scenario: Existing user registration
    Given a user already exists in the database with a particular email
    Given I set header "Content-Type" with value "application/json"
    When I send a POST request to "api/v1/register" with values:
      | first_name | Hrishikesh |
      | last_name  | Sawant     |
      | email      | hris@ex.com|
      | password   | chocopie   |
      | password_confirmation | chocopie |
    Then the response code should be 403


