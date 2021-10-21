package io;

import base.Entry;
import base.Product;
import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class SQLHandler {
    
    private final String dburl = "jdbc:mysql://localhost/picewatch";
    private final String username = "root";
    private final String password = "055510";
    private final Connection con;
    
    public SQLHandler() throws SQLException{
        this.con = DriverManager.getConnection(dburl, username, password);
    }
    @Override
    protected void finalize(){
        try {
            con.close();
        } catch (SQLException ex) {
        } finally {
            try {
                super.finalize();
            } catch (Throwable ex) {
            }
        }
    }
    public Connection getConnection(){
        return this.con;
    }
    public boolean sendEntry(Entry entry){
        try{
            PreparedStatement stmt = con.prepareStatement("INSERT INTO entry (price, product_id, currency) VALUES (?, ?,?);");
            stmt.setDouble(1, entry.getPrice());
            stmt.setInt(2, entry.getProductId());
            stmt.setString(3, entry.getCurrency());
            boolean result = stmt.execute();
            stmt.closeOnCompletion();
            return result;
        }catch(SQLException e){
            System.out.println(e.getMessage());
            return false;
        }
    }
    public List<Product> getProducts() throws SQLException{
        List<Product> products = new ArrayList();
        PreparedStatement stmt = con.prepareStatement("SELECT * FROM product;");
        ResultSet rs = stmt.executeQuery();
        while(rs.next()){ //id name url
            int id = rs.getInt("id");
            String name = rs.getString("name");
            String url = rs.getString("url");
            Product p = new Product(id, name, url);
            products.add(p);
        }
        return products;
    }
}
