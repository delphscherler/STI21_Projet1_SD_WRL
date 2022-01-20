INSERT INTO users (username, password, role) VALUES ('admin', '$2y$10$10A2opiYMZTbFif.DKb3SuXoMZryP7cwgf872AwwNQcikC92X5mQm', 1);
INSERT INTO users (username, password, role) VALUES ('test', '$2y$10$xGKGhH67gTG4ecd8ZTnCx.h5NxQXRNDeq94xKaGOQ.cpMOH7IuPse', 0);
INSERT INTO messages ("sender", "receiver", "subject", "date", "message") VALUES ('2', '1', 'Repas de midi', '2022-01-20', 'Bonjour');
INSERT INTO messages ("sender", "receiver", "subject", "date", "message") VALUES ('2', '1', 'Très important', '2022-01-19', 'Ceci est important!');
INSERT INTO messages ("sender", "receiver", "subject", "date", "message") VALUES ('1', '2', 'RE : Repas de midi', '2022-01-20', 'OK');
INSERT INTO messages ("sender", "receiver", "subject", "date", "message") VALUES ('1', '2', 'Bonjour', '2022-01-18', 'Comment allez-vous?');