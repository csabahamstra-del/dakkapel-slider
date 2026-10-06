-- Fictive development data: two security companies so tenant isolation is visible.
-- All names and addresses are made up.

insert into auth.users (id, email) values
  ('00000000-0000-4000-8000-00000000a001', 'eigenaar@noordwacht.test'),
  ('00000000-0000-4000-8000-00000000a002', 'planner@noordwacht.test'),
  ('00000000-0000-4000-8000-00000000b001', 'eigenaar@zuidschild.test');

insert into public.organizations (id, name, inbound_alias, branding) values
  ('10000000-0000-4000-8000-00000000000a', 'Noordwacht Beveiliging', 'noordwacht', '{"primary_color": "#0b3d91"}'),
  ('10000000-0000-4000-8000-00000000000b', 'Zuidschild Security', 'zuidschild', '{"primary_color": "#8a1c1c"}');

insert into public.members (organization_id, user_id, role) values
  ('10000000-0000-4000-8000-00000000000a', '00000000-0000-4000-8000-00000000a001', 'owner'),
  ('10000000-0000-4000-8000-00000000000a', '00000000-0000-4000-8000-00000000a002', 'planner'),
  ('10000000-0000-4000-8000-00000000000b', '00000000-0000-4000-8000-00000000b001', 'owner');

insert into public.clients (id, organization_id, name, contact_name, contact_email) values
  ('20000000-0000-4000-8000-00000000000a', '10000000-0000-4000-8000-00000000000a', 'Lindeboom Logistiek B.V.', 'Facilitair manager', 'facilitair@lindeboom.test'),
  ('20000000-0000-4000-8000-00000000000b', '10000000-0000-4000-8000-00000000000b', 'Westpoort Beheer', 'Gebouwbeheer', 'beheer@westpoort.test');

insert into public.sites (organization_id, client_id, name, street, house_number, postal_code, city, aliases) values
  ('10000000-0000-4000-8000-00000000000a', '20000000-0000-4000-8000-00000000000a', 'Distributiecentrum Noord', 'Industrieweg', '12', '8025 AB', 'Zwolle', array['DC Noord', 'DC Zwolle']),
  ('10000000-0000-4000-8000-00000000000b', '20000000-0000-4000-8000-00000000000b', 'Kantoorpand Westpoort', 'Havenstraat', '88', '1013 AA', 'Amsterdam', array['Westpoort kantoor']);
