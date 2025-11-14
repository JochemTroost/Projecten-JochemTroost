import random
from datetime import datetime, timedelta

# Mogelijke ticket types
ticket_types = ["Standaard"]

# Startdatum voor de bezoeken (alleen deze maand)
base_date = datetime(2025, 10, 17)

# Namenlijst voor bezoekers
names = ["Alice", "Bob", "Charlie", "Diana", "Eve", "Frank", "Grace", "Hank", "Ivy", "Jack", "Pascal", "Jochem", "Soad", "Jason"]

# Open een bestand om de SQL statements in te schrijven
with open("insert_10000_visitors.sql", "w", encoding="utf-8") as f:
    for i in range(3200, 4500):
        # Random naam, email, ticketnummer
        name = random.choice(names) + f" {i}"
        email = f"user{i}@example.com"
        ticket_number = f"TICKET-{1000+i}"

        # Random bezoekdatum in oktober
        visit_date = base_date + timedelta(days=random.randint(0, 30))

        # Ticket type
        ticket_type = random.choice(ticket_types)

        # Datum van aanmaken ticket
        created_at = datetime.now() - timedelta(days=random.randint(1, 30))

        # Aantal personen
        persons = random.randint(1, 4)

        # Prijs berekenen
        if ticket_type == "Standaard":
            total_price = 35 * persons
        elif ticket_type == "VIP":
            total_price = 55 * persons
        else:  # Senior
            total_price = 60 * persons

        # SQL statement
        sql = f"INSERT INTO visitors (name, email, ticket_number, visit_date, ticket_type, created_at, persons, total_price) " \
              f"VALUES ('{name}', '{email}', '{ticket_number}', '{visit_date.date()}', '{ticket_type}', '{created_at.strftime('%Y-%m-%d %H:%M:%S')}', {persons}, {total_price});\n"

        # Schrijf naar bestand
        f.write(sql)

print("SQL file with 7000 INSERT statements generated: insert_7000_visitors.sql")
