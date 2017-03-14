# NtpCustomerProductFilter

CustomerProductFilter For Magento 1.9

We have a client that requires a customer account section to return a list of products based on a range of prices entered. A customer will go to this section in the customer account (a new tab in customer account) and be presented with three input fields: low price, high price, and sort. Upon form submission the page should load via AJAX and display a list of products whose price falls within the submitted range. 

Finally, the client has ideas to expand this later and wants to make sure the requirements are enforced; form cannot submit on frontend unless frontend JavaScript validation is passed and form cannot submit if backend controller validation of required field data does not pass (to prevent manual manipulation).
