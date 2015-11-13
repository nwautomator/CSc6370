-- -----------------------------------------------------------------------------------*
--  Start by deleting all data before running to avoid duplicates.
-- -----------------------------------------------------------------------------------*
delete from mama.tbl_SaleProduct;
delete from mama.tbl_Sale;
delete from mama.tbl_ProductCoupon;
delete from mama.tbl_Coupon;
delete from mama.tbl_Product;
delete from mama.tbl_Customer;
delete from mama.tbl_Employee;
delete from mama.tbl_Category_lu;

-- -----------------------------------------------------------------------------------*
--  Create procedure to add categories to tbl_Category_lu.
--  Populate with initial records.
-- -----------------------------------------------------------------------------------*
drop procedure if exists mama.CategoryAdd;
delimiter $$
create procedure mama.CategoryAdd(
  in name_in  varchar (30)
  )
begin

  insert into mama.tbl_Category_lu( name )
       values ( name_in );

end$$
delimiter ;

call mama.CategoryAdd('Food and Beverage');
call mama.CategoryAdd('Medicine');
call mama.CategoryAdd('School Supplies');
call mama.CategoryAdd('Hygiene');
call mama.CategoryAdd('Home Decor');
call mama.CategoryAdd('General');
call mama.CategoryAdd('Seasonal');
call mama.CategoryAdd('Toys');
call mama.CategoryAdd('Tobacco');

-- -----------------------------------------------------------------------------------*
--  Create procedure to add customers to tbl_Customer.
--  Populate with initial records.
-- -----------------------------------------------------------------------------------*
drop procedure if exists mama.CustomerAdd;
delimiter $$
create procedure mama.CustomerAdd(
  in nameFirst_in      varchar(30),
  in nameLast_in       varchar(30),
  in phoneNumber_in    varchar(12),
  in email_in          varchar(80)
  )
begin

  insert into mama.tbl_Customer( nameFirst, nameLast, phoneNumber, email, createdDate )
       values ( nameFirst_in, nameLast_in, phoneNumber_in, email_in, curdate() );

end$$

delimiter ;

call mama.CustomerAdd( 'Charles', 'Xavier', '111-111-9626', 'professorx@xmen.com' );
call mama.CustomerAdd( 'Scott', 'Summers', '222-222-9626', 'cyclops@xmen.com' );
call mama.CustomerAdd( 'Robert', 'Drake', '333-333-9626', 'iceman@xmen.com' );
call mama.CustomerAdd( 'Warren', 'Worthington', '444-444-9626', 'archangel@xmen.com' );
call mama.CustomerAdd( 'Henry', 'Mccoy', '555-555-9626', 'beast@xmen.com' );
call mama.CustomerAdd( 'Jean', 'Grey', '666-666-9626', 'phoenix@xmen.com' );
call mama.CustomerAdd( 'Ororo', 'Monroe', '777-777-9626', 'storm@xmen.com' );
call mama.CustomerAdd( 'Anna', 'Marie', '888-888-9626', 'rogue@xmen.com' );
call mama.CustomerAdd( 'Remy', 'LeBeau', '999-999-9626', 'gambit@xmen.com' );
call mama.CustomerAdd( 'Logan', 'Howlett', '000-000-9626', 'wolverine@xmen.com' );
call mama.CustomerAdd( 'Scott', 'Michael', '000-000-1111', '@theoffice.com' );
call mama.CustomerAdd( 'Helpert', 'Jim', '000-000-2222', '@theoffice.com' );
call mama.CustomerAdd( 'Shrute', 'Dwight', '000-000-3333', '@theoffice.com' );
call mama.CustomerAdd( 'Beasley', 'Pam', '000-000-4444', '@theoffice.com' );
call mama.CustomerAdd( 'Shrute', 'Angela', '000-000-5555', '@theoffice.com' );
call mama.CustomerAdd( 'Santos', 'Oscar', '000-000-6666', '@theoffice.com' );
call mama.CustomerAdd( 'Refridgeration', 'Vance', '000-000-6666', '@theoffice.com' );
call mama.CustomerAdd( 'Dalton', 'Andy', '000-000-6666', '@theoffice.com' );
call mama.CustomerAdd( 'Kapoor', 'Kelly', '000-000-6666', '@theoffice.com' );
call mama.CustomerAdd( 'McGuire', 'Toby', '000-000-6666', '@theoffice.com' );
call mama.CustomerAdd( 'Carell', 'Steve', '000-000-6666', '@theoffice.com' );
call mama.CustomerAdd( 'Livingson', 'Jan', '000-000-6666', '@theoffice.com' );

-- -----------------------------------------------------------------------------------*
--  Create procedure to add employees to tbl_Employee.
--  Populate with initial records.
-- -----------------------------------------------------------------------------------*
drop procedure if exists mama.EmployeeAdd;
delimiter $$
create procedure mama.EmployeeAdd(
  in logonName_in    varchar (15),
  in password_in     varchar (255),
  in nameFirst_in    varchar (30),
  in nameLast_in     varchar (30),
  in admin_in        varchar (1),
  in hireDate_in     date
  )
begin

  insert into mama.tbl_Employee( logonName, password, nameFirst, nameLast, hireDate, admin )
       values ( logonName_in, password_in, nameFirst_in, nameLast_in, hireDate_in, admin_in );

end$$

delimiter ;

call mama.EmployeeAdd( 'mwoodie', '5f4dcc3b5aa765d61d8327deb882cf99', 'Michael', 'Woodie', 'Y', curdate());
call mama.EmployeeAdd( 'cfreas', '5f4dcc3b5aa765d61d8327deb882cf99', 'Chris', 'Freas', 'Y', curdate());
call mama.EmployeeAdd( 'blai', '5f4dcc3b5aa765d61d8327deb882cf99', 'Brandon', 'Lai', 'Y', curdate());
call mama.EmployeeAdd( 'ggerst', '5f4dcc3b5aa765d61d8327deb882cf99', 'Rett', 'Gerst', 'Y', curdate());
call mama.EmployeeAdd( 'sluong', '5f4dcc3b5aa765d61d8327deb882cf99', 'Seyana', 'Luong', 'Y', curdate());

-- -----------------------------------------------------------------------------------*
--  Create procedure to add products to tbl_Product.
--  Populate with initial records.
-- -----------------------------------------------------------------------------------*
drop procedure if exists mama.ProductAdd;
delimiter $$
create procedure mama.ProductAdd(
  in categoryId_in       int     (9),
  in name_in             varchar (30),
  in price_in            decimal (9,2),
  in inventoryAmount_in  int     (9)
  )
begin

  insert into mama.tbl_Product( categoryId, name, price, inventoryAmount, lastStockDate )
       values ( categoryId_in, name_in, price_in, inventoryAmount_in, curdate() );
end$$

delimiter ;

call mama.ProductAdd( 1, 'Beer', 11.99, 15 );
call mama.ProductAdd( 1, 'Bread', 4.99, 15 );
call mama.ProductAdd( 1, 'Chips', 4.99, 10 );
call mama.ProductAdd( 1, 'Candy', 1.99, 10 );
call mama.ProductAdd( 2, 'Headache Powder', 9.99, 10 );
call mama.ProductAdd( 3, 'Notebook', 1.99, 20 );
call mama.ProductAdd( 4, 'Shampoo', 4.99, 8 );
call mama.ProductAdd( 4, 'Deodorant', 3.99, 10 );
call mama.ProductAdd( 4, 'Toothbrush', 2.99, 10 );
call mama.ProductAdd( 4, 'Toothpaste', 4.99, 10 );
call mama.ProductAdd( 4, 'Soap', 6.99, 8 );
call mama.ProductAdd( 5, 'Candles', 5.99, 6 );
call mama.ProductAdd( 6, 'Batteries', 7.99, 10 );
call mama.ProductAdd( 7, 'Casper Costume', 19.99, 4 );
call mama.ProductAdd( 7, 'Pumpkin', 13.99, 8 );
call mama.ProductAdd( 8, 'Cap Gun', 5.99, 5 );
call mama.ProductAdd( 8, 'Doll', 9.99, 5 );
call mama.ProductAdd( 8, 'Yo-Yo', 5.99, 5 );
call mama.ProductAdd( 9, 'Dip', 6.99, 10 );
call mama.ProductAdd( 9, 'Cigars', 9.99, 10 );

-- -----------------------------------------------------------------------------------*
--  Create procedure to add sales to tbl_Sale.
-- -----------------------------------------------------------------------------------*
drop procedure if exists mama.SaleAdd;
delimiter $$
create procedure mama.SaleAdd(
  in cashierId_in   int (9),
  in customerId_in  int (9),
  in day_in         int (9)
  )
begin
	
  insert into mama.tbl_Sale( cashierId, customerId, saleTotal, saleDate )
       values ( cashierId_in, customerId_in, 0.00, curdate() - interval day_in day);
end$$
delimiter ;

-- -----------------------------------------------------------------------------------*
--  Create procedure to update saleTotal on tbl_Sale.
-- -----------------------------------------------------------------------------------*
drop procedure if exists mama.SaleUpdateSaleTotal;
delimiter $$
create procedure mama.SaleUpdateSaleTotal(
  in saleId_in   int (9)
  )
begin
	declare mtotal decimal(9,2);
	
	select sum(p.price * sp.amount) as total
	  into mtotal
	  from mama.tbl_SaleProduct sp
	  join mama.tbl_Product p
	    on p.productId = sp.productId
	 where sp.saleId = saleId_in;
	 
	update mama.tbl_Sale
	   set saleTotal = mtotal
	 where saleId = saleId_in;
	
end$$
delimiter ;

-- -----------------------------------------------------------------------------------*
--  Create procedure to add product purchases to tbl_SaleProduct.
-- -----------------------------------------------------------------------------------*
drop procedure if exists mama.SaleProductAdd;
delimiter $$
create procedure mama.SaleProductAdd(
  in saleId_in     int (9),
  in productId_in  int (9),
  in amount_in     int (9)
  )
begin
	
  insert into mama.tbl_SaleProduct( saleId, productId, amount )
       values ( saleId_in, productId_in, amount_in );
end$$
delimiter ;

-- -----------------------------------------------------------------------------------*
--  Populate tbl_Sale and tbl_SaleProduct
-- -----------------------------------------------------------------------------------*

drop procedure if exists mama.populate;
delimiter $$
create procedure mama.populate()

  begin
    declare i int default 1;
    declare msaleId int;
    declare mrand int;
    declare mcashId int;
    declare mcustId int;

    simple_loop: loop

      select employeeId
        into mcashId
        from mama.tbl_Employee
    order by rand()
       limit 1;

      select customerId
        into mcustId
        from mama.tbl_Customer
    order by rand()
       limit 1;

      call mama.saleAdd( mcashId, mcustId, ( ceil( rand() * 90)));

      select last_insert_Id()
        into msaleId;

      insert into mama.tbl_SaleProduct( saleId, productId, amount)
      select msaleId, p.productId, ceil( rand() * 3)
	    from mama.tbl_Product p
	order by rand()
	   limit 3;
	   
	   call mama.SaleUpdateSaleTotal( msaleId );

      set i=i+1;

      if i=100 then
        leave simple_loop;
      end if;
  end loop simple_loop;
end $$

delimiter ;

call mama.populate;

-- -----------------------------------------------------------------------------------*
--  Create procedure to add coupons to tbl_Coupon.
-- -----------------------------------------------------------------------------------*
drop procedure if exists mama.CouponAdd;
delimiter $$
create procedure mama.CouponAdd(
  in name_in            varchar (30),
  in amount_in          decimal (9,2),
  in firstday_in        date,
  in lastday_in         date
  )
begin
	
  insert into mama.tbl_Coupon( name, amount, startDate, endDate, active )
       values ( name_in, amount_in, firstday_in, lastday_in, 'Y');
end$$
delimiter ;

call mama.CouponAdd( 'Save on Miller Lite', 2.50, curdate() - interval 10 day, curdate() + interval 30 day);
call mama.CouponAdd( 'Sunbeam Loaves', .30, curdate() - interval 20 day, curdate() - interval 5 day);
call mama.CouponAdd( 'Sunchips', .50, curdate() - interval 30 day, curdate() - interval 5 day);
call mama.CouponAdd( 'Skittles - save a dollar', 1.00, curdate() - interval 30 day, curdate() + interval 30 day);
call mama.CouponAdd( 'Colgate', .50, curdate() - interval 2 day, curdate() + interval 30 day);

-- -----------------------------------------------------------------------------------*
--  Create procedure to add coupons to products in tbl_ProductCoupon.
-- -----------------------------------------------------------------------------------*
drop procedure if exists mama.ProductCouponAdd;
delimiter $$
create procedure mama.ProductCouponAdd(
  in couponId_in    int (30),
  in productId_in   int (30)
  )
  begin
  	
	 insert into mama.tbl_ProductCoupon( couponId, productId )
	      values ( couponId_in, productId_in );
  end$$
  delimiter ;
  
call mama.ProductCouponAdd( 1,1);
call mama.ProductCouponAdd( 2,2);
call mama.ProductCouponAdd( 3,3);
call mama.ProductCouponAdd( 4,4);
call mama.ProductCouponAdd( 5,9);

drop procedure if exists mama.UpdateWithCoupon;
delimiter $$
create procedure mama.UpdateWithCoupon()
  begin
  	
	declare msaleId int;
	
	select saleId
	  into msaleId
	  from mama.tbl_SaleProduct
	 where productId = 1
  order by rand()
     limit 1;
	 
	update mama.tbl_SaleProduct s
	   set s.couponId = 1
	 where s.saleId = msaleId
	   and s.productId = 1;
	 
	select saleId
	  into msaleId
	  from mama.tbl_SaleProduct
	 where productId = 1
  order by rand()
     limit 1;
	 
	update mama.tbl_SaleProduct s
	   set s.couponId = 1
	 where s.saleId = msaleId
	   and s.productId = 1;
	 
	select saleId
	  into msaleId
	  from mama.tbl_SaleProduct
	 where productId = 1
  order by rand()
     limit 1;
	 
	update mama.tbl_SaleProduct s
	   set s.couponId = 1
	 where s.saleId = msaleId
	   and s.productId = 1;
	 
	select saleId
	  into msaleId
	  from mama.tbl_SaleProduct
	 where productId = 1
  order by rand()
     limit 1;
	 
	update mama.tbl_SaleProduct s
	   set s.couponId = 1
	 where s.saleId = msaleId
	   and s.productId = 1;
	 
	 select saleId
	  into msaleId
	  from mama.tbl_SaleProduct
	 where productId = 2
  order by rand()
     limit 1;
	 
	update mama.tbl_SaleProduct s
	   set s.couponId = 2
	 where s.saleId = msaleId
	   and s.productId = 2;
	   
	 select saleId
	  into msaleId
	  from mama.tbl_SaleProduct
	 where productId = 3
  order by rand()
     limit 1;
	 
	update mama.tbl_SaleProduct s
	   set s.couponId = 3
	 where s.saleId = msaleId
	   and s.productId = 3;
	   
	select saleId
	  into msaleId
	  from mama.tbl_SaleProduct
	 where productId = 4
  order by rand()
     limit 1;
	 
	update mama.tbl_SaleProduct s
	   set s.couponId = 4
	 where s.saleId = msaleId
	   and s.productId = 4;
	   
		select saleId
	  into msaleId
	  from mama.tbl_SaleProduct
	 where productId = 4
  order by rand()
     limit 1;
	 
	update mama.tbl_SaleProduct s
	   set s.couponId = 4
	 where s.saleId = msaleId
	   and s.productId = 4;
	
	select saleId
	  into msaleId
	  from mama.tbl_SaleProduct
	 where productId = 4
  order by rand()
     limit 1;
	 
	update mama.tbl_SaleProduct s
	   set s.couponId = 4
	 where s.saleId = msaleId
	   and s.productId = 4;	
	 
	select saleId
	  into msaleId
	  from mama.tbl_SaleProduct
	 where productId = 4
  order by rand()
     limit 1;
	 
	update mama.tbl_SaleProduct s
	   set s.couponId = 4
	 where s.saleId = msaleId
	   and s.productId = 4;	
	 
    select saleId
	  into msaleId
	  from mama.tbl_SaleProduct
	 where productId = 4
  order by rand()
     limit 1;
	 
	update mama.tbl_SaleProduct s
	   set s.couponId = 4
	 where s.saleId = msaleId
	   and s.productId = 4;   
	   
	select saleId
	  into msaleId
	  from mama.tbl_SaleProduct
	 where productId = 9
  order by rand()
     limit 1;
	 
	update mama.tbl_SaleProduct s
	   set s.couponId = 5
	 where s.saleId = msaleId
	   and s.productId = 9;

	select saleId
	  into msaleId
	  from mama.tbl_SaleProduct
	 where productId = 9
  order by rand()
     limit 1;
	 
	update mama.tbl_SaleProduct s
	   set s.couponId = 5
	 where s.saleId = msaleId
	   and s.productId = 9;

	select saleId
	  into msaleId
	  from mama.tbl_SaleProduct
	 where productId = 9
  order by rand()
     limit 1;
	 
	update mama.tbl_SaleProduct s
	   set s.couponId = 5
	 where s.saleId = msaleId
	   and s.productId = 9;

  end$$
  delimiter ;
  
call mama.UpdateWithCoupon;
	   
