DROP TABLE IF EXISTS public.goals, public.categories, public.budgets, public.users;

CREATE TABLE public.users
(
	id SERIAL NOT NULL PRIMARY KEY,
	username VARCHAR(100) NOT NULL UNIQUE,
	password VARCHAR(100) NOT NULL,
	display_name VARCHAR(100) NOT NULL
);

INSERT INTO public.users 
(username, password, display_name) VALUES 
('user1', 'pass123', 'firstGuy'),
('user2', 'pass321', 'secondGuy');

CREATE TABLE public.budgets
(
	id SERIAL NOT NULL PRIMARY KEY,
	name VARCHAR(100) NOT NULL,
	userId INT NOT NULL REFERENCES public.users(id)
);

INSERT INTO public.budgets 
(name, userId) VALUES
('bud1u1', 1),
('bud2u1', 1),
('bud1u2', 2),
('bud2u2', 2);

CREATE TABLE public.categories
(
	id SERIAL NOT NULL PRIMARY KEY,
	categoryName VARCHAR(100) NOT NULL,
	budgetId INT NOT NULL REFERENCES public.budgets(id)
);

INSERT INTO public.categories 
(categoryName, budgetId) VALUES
('total', 1),
('total', 2),
('total', 3),
('total', 4);

CREATE TABLE public.goals
(
	id SERIAL NOT NULL PRIMARY KEY,
	goalFunds MONEY NOT NULL,
	goalWeek SMALLINT NOT NULL,
	categoryID INT NOT NULL REFERENCES public.categories(id),
	budgetId INT NOT NULL REFERENCES public.budgets(id)
);

INSERT INTO public.goals
(goalFunds, goalWeek, categoryID, budgetId) VALUES
(10.00, 1, 1, 1),
(11.00, 2, 1, 1),
(12.00, 3, 1, 1),
(14.00, 4, 1, 1);

