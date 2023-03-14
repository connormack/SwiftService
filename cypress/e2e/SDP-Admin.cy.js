describe("Admin", () => {
  it("Follows Admin path", () => {
    cy.visit("http://localhost/SDP/admin");

    cy.get(".username").type("admin").should("have.value", "admin");

    cy.get(".password").type("admin").should("have.value", "admin");

    cy.get(".btn-primary").click();

    cy.get(".success").should("have.text", "Login Success.");

    cy.contains("Orders").click();

    cy.contains("Burger");
    cy.contains("10.00");
    cy.contains("Ordered");
    cy.contains("John Doe");
    cy.contains("01234567890");
    cy.contains("JohnDoe@gmail.com");
    cy.contains("12");
    cy.contains("Update Order").click();
    cy.contains("Burger");

    cy.get(".qty").should("have.value", "1");
    cy.get(".total").should("have.value", "£10.00");
    cy.get(".status").should("have.value", "Ordered");
    cy.get(".name").should("have.value", "John Doe");
    cy.get(".contact").should("have.value", "01234567890");
    cy.get(".email").should("have.value", "JohnDoe@gmail.com");
    cy.get(".table-number").should("have.value", "12");

    cy.get(".status")
      .select("Preparing Order")
      .should("have.value", "Preparing Order");

    cy.get(".btn-secondary").click();

    cy.get(".success").should("have.text", "Order Updated Successfully.");

    cy.contains("Update Order").click();
    cy.contains("Burger");

    cy.get(".qty").should("have.value", "1");
    cy.get(".total").should("have.value", "£10.00");
    cy.get(".status").should("have.value", "Preparing Order");
    cy.get(".name").should("have.value", "John Doe");
    cy.get(".contact").should("have.value", "01234567890");
    cy.get(".email").should("have.value", "JohnDoe@gmail.com");
    cy.get(".table-number").should("have.value", "12");

    cy.get(".status").select("Completed").should("have.value", "Completed");

    cy.get(".btn-secondary").click();

    cy.get(".success").should("have.text", "Order Updated Successfully.");
  });
});
