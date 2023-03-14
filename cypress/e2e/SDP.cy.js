describe("Customer", () => {
  it("Follows customer path", () => {
    cy.visit("http://localhost/SDP/landing.php");

    cy.get(".landing-input").type("10").should("have.value", "10");

    cy.get(".landing-button").click();

    cy.contains("Full Menu").click();

    cy.contains("Burger");

    cy.get(".btn-primary").last().click();

    cy.get(".full-name").type("John Doe");

    cy.get(".phone").type("01234567890");

    cy.get(".email").type("JohnDoe@gmail.com");

    cy.get(".table-number").type("12");

    cy.get(".card-number").type("1234 4567 9101 1121");

    cy.get(".card-expiry").type("01/23");

    cy.get(".security-code").type("123");

    cy.get(".btn-primary").last().click();

    cy.get(".success").should("have.text", "Order Has Been Successful.");
  });
});
