-- -----------------------------------------------------------------------------------*
--  Populate tbl_Sale and tbl_SaleProduct
-- -----------------------------------------------------------------------------------*

call mama.SaleAdd( 1,1, 60);
call mama.SaleProductAdd( 1,8,1);
call mama.SaleProductAdd( 1,5,3);
call mama.SaleProductAdd( 1,2,2);
call mama.SaleUpdateSaleTotal(1);

call mama.SaleAdd( 1,2, 5);
call mama.SaleProductAdd( 2,1,1);
call mama.SaleProductAdd( 2,2,2);
call mama.SaleProductAdd( 2,4,2);
call mama.SaleUpdateSaleTotal(2);

call mama.SaleAdd( 1,3, 94);
call mama.SaleProductAdd( 3,6,1);
call mama.SaleUpdateSaleTotal(3);

call mama.SaleAdd( 1,4, 7);
call mama.SaleProductAdd( 4,8,1);
call mama.SaleProductAdd( 4,10,2);
call mama.SaleUpdateSaleTotal(4);

call mama.SaleAdd( 2,5, 14);
call mama.SaleProductAdd( 5,8,1);
call mama.SaleProductAdd( 5,10,2);
call mama.SaleProductAdd( 5,11,1);
call mama.SaleUpdateSaleTotal(5);

call mama.SaleAdd( 2,6, 6);
call mama.SaleProductAdd( 6,8,1);
call mama.SaleProductAdd( 6,10,1);
call mama.SaleProductAdd( 6,1,2);
call mama.SaleProductAdd( 6,12,1);
call mama.SaleProductAdd( 6,5,2);
call mama.SaleUpdateSaleTotal(6);

call mama.SaleAdd( 3,1, 3);
call mama.SaleProductAdd( 7,13,1);
call mama.SaleProductAdd( 7,9,3);
call mama.SaleProductAdd( 7,7,2);
call mama.SaleUpdateSaleTotal(7);

call mama.SaleAdd( 5,2,14);
call mama.SaleProductAdd( 8,20,1);
call mama.SaleUpdateSaleTotal(8);

call mama.SaleAdd( 5,7, 67);
call mama.SaleProductAdd( 9,20,1);
call mama.SaleUpdateSaleTotal(9);

call mama.SaleAdd( 5,8, 2);
call mama.SaleProductAdd( 10,17,2);
call mama.SaleProductAdd( 10,16,1);
call mama.SaleProductAdd( 10,13,3);
call mama.SaleUpdateSaleTotal(10);

call mama.SaleAdd( 5,9, 22);
call mama.SaleProductAdd( 11,18,2);
call mama.SaleProductAdd( 11,6,1);
call mama.SaleProductAdd( 11,2,3);
call mama.SaleUpdateSaleTotal(11);

call mama.SaleAdd( 5,10, 4);
call mama.SaleProductAdd( 12,8,1);
call mama.SaleProductAdd( 12,6,1);
call mama.SaleProductAdd( 12,2,3);
call mama.SaleProductAdd( 12,16,3);
call mama.SaleProductAdd( 12,7,1);
call mama.SaleProductAdd( 12,3,1);
call mama.SaleUpdateSaleTotal(12);