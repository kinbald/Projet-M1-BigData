DO $$
BEGIN
  FOR counter IN 1..100 LOOP
    INSERT INTO "base_user" (id, firstname, lastname, sub_date, discr) VALUES (counter, random_string(10), random_string(10),
    timestamp '2014-01-10 20:00:00' + random() * (timestamp '2016-01-10 20:00:00' - timestamp '2014-01-10 10:00:00'),
    base_user_descr()
    );
  END LOOP;

  FOR counter IN 1..100 LOOP
    INSERT INTO "user_consumer" (id, sex, birth_date) VALUES (counter, random_Homme_Femme(),
      timestamp '2016-01-01 20:00:00' + random() * (timestamp '2018-01-10 20:00:00' - timestamp '2017-01-10 20:00:00')
    );
  END LOOP;

  FOR counter IN 1..100 LOOP
    INSERT INTO "user_media" (id, company_name, url_blog, id_presse) VALUES (counter, random_string(10),
      random_string(30), random_string(30)
    );
  END LOOP;

  FOR counter IN 1..100 LOOP
    INSERT INTO "user_producer" (id, siret, company_name, address, city, postal_code)
    VALUES (counter, random_number(14), random_string(10), random_string(30), random_string(10), random_number(5)
    );
  END LOOP;

  FOR counter IN 1..100 LOOP
    INSERT INTO "product" (id, name, description, volume, price, stock, discr)
    VALUES (counter, random_string(10), random_string(10), FLOOR(random()*100),
    random()*100, FLOOR(random()*1000), base_user_descr()
    );
  END LOOP;

  FOR counter IN 1..100 LOOP
    INSERT INTO "universe" (id, name, description) VALUES (counter, random_string(10), random_string(10)
    );
  END LOOP;

  FOR counter IN 1..100 LOOP
    INSERT INTO "wine" (id, vintage, color) VALUES (counter,
      timestamp '1980-01-01 20:00:00' + random() * (timestamp '2018-01-10 20:00:00' - timestamp '1980-01-10 20:00:00'),
      random_string(10)
    );
  END LOOP;

  FOR counter IN 1..100 LOOP
    INSERT INTO "competition" (id, name, description, date_competition)
    VALUES (counter, random_string(10), random_string(10),
    timestamp '2017-01-01 20:00:00' + random() * (timestamp '2018-01-10 20:00:00' - timestamp '2017-01-10 20:00:00')
    );
   END LOOP;

  FOR counter IN 1..100 LOOP
    INSERT INTO "competition_wine" (id, competition_id, wine_id, prime_name) VALUES (counter, counter, counter, random_string(10)
    );
  END LOOP;

  FOR counter IN 1..100 LOOP
    INSERT INTO "option" (id, name, description, price) VALUES
      (counter, random_string(10), random_string(20), random()*100
    );
  END LOOP;

  FOR counter IN 1..100 LOOP
    INSERT INTO "option_subscription" (id, option_id, user_id, date_subscription) VALUES (counter, counter, counter,
    timestamp '2016-01-01 20:00:00' + random() * (timestamp '2018-01-10 20:00:00' - timestamp '2017-01-10 20:00:00')
    );
  END LOOP;

  FOR counter IN 1..100 LOOP
    INSERT INTO "picture_product" (id, product_id, alt, url)
    VALUES (counter, 101 - counter, random_string(10),random_string(30)
    );
  END LOOP;

  FOR counter IN 1..100 LOOP
    INSERT INTO "picture_universe" (id, universe_id, alt, url)
    VALUES (counter, 101 - counter, random_string(10),random_string(30)
    );
  END LOOP;

  FOR counter IN 1..100 LOOP
    INSERT INTO "product_evaluation" (id, product_id, user_id, mark, review) VALUES (counter, counter, counter,
    FLOOR(random()*20),random_string(40)
    );
  END LOOP;

  FOR counter IN 1..100 LOOP
    INSERT INTO "purchase" (id, user_id, address, city, postal_code, country, done, date_order ) VALUES (counter,
      101-counter,random_string(30), random_string(10), random_number(5), random_string(10), true_false(),
      timestamp '2016-01-01 20:00:00' + random() * (timestamp '2018-01-10 20:00:00' - timestamp '2017-01-10 20:00:00')
    );
  END LOOP;

  FOR counter IN 1..100 LOOP
    INSERT INTO "product_purchase" (id, purchase_id, product_id, stock) VALUES (counter, counter, counter,
    floor(random()*100)
    );
  END LOOP;

  FOR counter IN 1..100 LOOP
    INSERT INTO "spirit" (id, alcohol_degree) VALUES (counter, floor(random()*100));
  END LOOP;

  FOR counter IN 1..100 LOOP
    INSERT INTO "universe_product" (universe_id, product_id) VALUES (counter, counter
    );
  END LOOP;

END; $$