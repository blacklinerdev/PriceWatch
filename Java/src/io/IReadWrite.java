package io;

import base.Entry;
import base.Product;
import java.util.List;

public interface IReadWrite {
    
    public List<Product> load();
    public void save(List<Product> list);
    public void appendProduct(Product product);
    public void appendUser(Product product);
    public void appendEntry(Product product);
    
}
