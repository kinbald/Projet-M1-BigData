create or replace function random_string(length integer) returns text as
$$
declare
  chars text[] := '{a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z}';
  result text := '';
  i integer := 0;
begin
  if length < 0 then
    raise exception 'Given length cannot be less than 0';
  end if;
  for i in 1..length loop
    result := result || chars[1+random()*(array_length(chars, 1)-1)];
  end loop;
  return result;
end;
$$ language plpgsql;



create or replace function random_Homme_Femme() returns text as
$$
declare
  chars text[] := '{H, F}';
  result text := '';
  i integer := 0;
begin
    result := result || chars[1+random()*(array_length(chars, 1)-1)];
  return result;
end;
$$ language plpgsql;



create or replace function random_number(length integer) returns text as
$$
declare
  chars text[] := '{0,1,2,3,4,5,6,7,8,9}';
  result text := '';
  i integer := 0;
begin
  if length < 0 then
    raise exception 'Given length cannot be less than 0';
  end if;
  for i in 1..length loop
    result := result || chars[1+random()*(array_length(chars, 1)-1)];
  end loop;
  return result;
end;
$$ language plpgsql;



create or replace function true_false() returns BOOLEAN as
$$
begin
  if random() > 0.5 then
    return TRUE ;
  else
    return FALSE ;
  end if;
end;
$$ language plpgsql;



create or replace function base_user_descr() returns text as
$$
declare
  i DOUBLE PRECISION := random();
begin
  if i < 0.33333 then
    return 'consumer' ;
  elseif i < 0.66666 then
    return 'media' ;
  else
    return 'producer' ;
  end if;
end;
$$ language plpgsql;