import React, { Component } from "react";
import ReactDOM from "react-dom";
import axios from "axios";
import Swal from "sweetalert2";
import { sum } from "lodash";

class CartPurchase extends Component {
    constructor(props) {
        super(props);
        this.state = {
            cart: [],
            products: [],
            suppliers: [],
            barcode: "",
            search: "",
            supplier_id: "",
            subject: "",
            description: "",
            expected_delivery_date: ""
        };

        this.loadCart = this.loadCart.bind(this);
        this.handleOnChangeBarcode = this.handleOnChangeBarcode.bind(this);
        this.handleScanBarcode = this.handleScanBarcode.bind(this);
        this.handleChangeQty = this.handleChangeQty.bind(this);
        this.handleEmptyCart = this.handleEmptyCart.bind(this);

        this.loadProducts = this.loadProducts.bind(this);
        this.handleChangeSearch = this.handleChangeSearch.bind(this);
        this.handleSeach = this.handleSeach.bind(this);
        this.setSupplierId = this.setSupplierId.bind(this);
        this.setSubject = this.setSubject.bind(this);
        this.setDescription = this.setDescription.bind(this);
        this.setDeliveryDate = this.setDeliveryDate.bind(this);
        this.handleClickSubmit = this.handleClickSubmit.bind(this)
    }

    componentDidMount() {
        // load user cart
        this.loadCart();
        this.loadProducts();
        this.loadSuppliers();
    }

    loadSuppliers() {
        axios.get(`/admin/supplier_contacts`).then(res => {
            const suppliers = res.data;
            this.setState({ suppliers });
        });
    }

    loadProducts(search = "") {
        const query = !!search ? `?search=${search}` : "";
        axios.get(`/admin/products${query}`).then(res => {
            const products = res.data.data;
            this.setState({ products });
        });
    }

    handleOnChangeBarcode(event) {
        const barcode = event.target.value;
        console.log(barcode);
        this.setState({ barcode });
    }

    loadCart() {
        axios.get("/admin/cart2").then(res => {
            const cart = res.data;
            this.setState({ cart });
        });
    }

    handleScanBarcode(event) {
        event.preventDefault();
        const { barcode } = this.state;
        if (!!barcode) {
            axios
                .post("/admin/cart2", { barcode })
                .then(res => {
                    this.loadCart();
                    this.setState({ barcode: "" });
                })
                .catch(err => {
                    Swal.fire("Error!", err.response.data.message, "error");
                });
        }
    }

    handleChangeQty(product_id, qty) {
        const cart = this.state.cart.map(c => {
            if (c.id === product_id) {
                c.pivot.quantity = qty;
            }
            return c;
        });

        this.setState({ cart });

        axios
            .post("/admin/cart2/change-qty", { product_id, quantity: qty })
            .then(res => { })
            .catch(err => {
                Swal.fire("Error!", err.response.data.message, "error");
            });
    }

    getTotal(cart) {
        const total = cart.map(c => c.pivot.quantity * c.price);
        return sum(total).toFixed(2);
    }

    handleClickDelete(product_id) {
        axios
            .post("/admin/cart2/delete", { product_id, _method: "DELETE" })
            .then(res => {
                const cart = this.state.cart.filter(c => c.id !== product_id);
                this.setState({ cart });
            });
    }

    handleEmptyCart() {
        axios.post("/admin/cart2/empty", { _method: "DELETE" }).then(res => {
            this.setState({ cart: [] });
        });
    }

    handleChangeSearch(event) {
        const search = event.target.value;
        this.setState({ search });
    }

    handleSeach(event) {
        if (event.keyCode === 13) {
            this.loadProducts(event.target.value);
        }
    }

    addProductToCart(barcode) {
        let product = this.state.products.find(p => p.barcode === barcode);
        if (!!product) {
            // if product is already in cart
            let cart = this.state.cart.find(c => c.id === product.id);
            if (!!cart) {
                // update quantity
                this.setState({
                    cart: this.state.cart.map(c => {
                        if (c.id === product.id && product.quantity > c.pivot.quantity) {
                            c.pivot.quantity = c.pivot.quantity + 1;
                        }
                        return c;
                    })
                });
            } else {
                if (product.quantity > 0) {
                    product = {
                        ...product,
                        pivot: {
                            quantity: 1,
                            product_id: product.id,
                            user_id: 1
                        }
                    };

                    this.setState({ cart: [...this.state.cart, product] });
                }
            }

            axios
                .post("/admin/cart2", { barcode })
                .then(res => {
                    // this.loadCart();
                    console.log(res);
                })
                .catch(err => {
                    Swal.fire("Error!", err.response.data.message, "error");
                });
        }
    }

    setSupplierId(event) {
        this.setState({ supplier_id: event.target.value });
    }
    setSubject(event) {
        this.setState({ subject: event.target.value });
    }
    setDescription(event) {
        this.setState({ description: event.target.value });
    }
    setDeliveryDate(event) {
        this.setState({ expected_delivery_date: event.target.value });
    }

    handleClickSubmit() {
        Swal.fire({
            title: 'Total Amount',
            input: 'text',
            inputValue: this.getTotal(this.state.cart),
            showCancelButton: true,
            confirmButtonText: 'Continue',
            showLoaderOnConfirm: true,
            preConfirm: (amount) => {
                return axios.post('/admin/purchases', { supplier_id: this.state.supplier_id, amount: amount, subject: this.state.subject,
                description: this.state.description, expected_delivery_date: this.state.expected_delivery_date }).then(res => {
                    this.loadCart();
                    return res.data;
                }).catch(err => {
                    Swal.showValidationMessage(err.response.data.message)
                })
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.value) {
                //
            }
        })

    }
    render() {
        const { cart, products, suppliers, barcode, subject, description, expected_delivery_date } = this.state;
        return (
            <div className="row">
                <div className="col-md-6 col-lg-6">
                    <div className="row mb-2">
                        <div className="col">
                            <form onSubmit={this.handleScanBarcode}>
                                <input
                                    type="text"
                                    className="form-control"
                                    placeholder="Scan Barcode..."
                                    value={barcode}
                                    onChange={this.handleOnChangeBarcode}
                                />
                            </form>
                        </div>
                        <div className="col">
                            <select
                                className="form-control"
                                onChange={this.setSupplierId}
                            >
                                <option value="">--Select Supplier--</option>
                                {suppliers.map(cus => (
                                    <option
                                        key={cus.id}
                                        value={cus.id}
                                    >{`${cus.first_name} ${cus.last_name}`}</option>
                                ))}
                            </select>
                        </div>
                    </div>
                    <div className="user-cart">
                        <div className="card">
                            <table className="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th className="text-right">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {cart.map(c => (
                                        <tr key={c.id}>
                                            <td>{c.name}</td>
                                            <td>
                                                <input
                                                    type="text"
                                                    className="form-control form-control-sm qty"
                                                    value={c.pivot.quantity}
                                                    onChange={event =>
                                                        this.handleChangeQty(
                                                            c.id,
                                                            event.target.value
                                                        )
                                                    }
                                                />
                                                <button
                                                    className="btn btn-danger btn-sm"
                                                    onClick={() =>
                                                        this.handleClickDelete(
                                                            c.id
                                                        )
                                                    }
                                                >
                                                    <i className="fas fa-trash"></i>
                                                </button>
                                            </td>
                                            <td className="text-right">
                                                {window.APP.currency_symbol}{" "}
                                                {(
                                                    c.price * c.pivot.quantity
                                                ).toFixed(2)}
                                            </td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div className="row mb-2">
                        <div className="col">Total:</div>
                        <div className="col text-right">
                            {window.APP.currency_symbol} {this.getTotal(cart)}
                        </div>
                    </div>
                    <div className="row mb-2">
                        <div className="col">Expected delivery date:</div>
                        <div className="col text-left pl-0">
                        <input
                            type="date" id="expected_delivery_date"
                            className="form-control"
                            value={this.state.expected_delivery_date}
                            onChange={event =>
                                this.setDeliveryDate(
                                    event
                                )
                            }
                        />
                        </div>
                    </div>
                    <div className="row mb-2">
                        <div className="col">Subject:</div>
                        <div className="col pl-0">
                        <input
                            required
                            type="text"
                            id="subject"
                            className="form-control"
                            placeholder="Enter subject..."
                            value={this.state.subject}
                            onChange={event =>
                                this.setSubject(
                                    event
                                )
                            }
                        />
                        </div>
                    </div>
                    <div className="row mb-2">
                        <div className="col">Description:</div>
                        <div className="col pl-0">
                            <textarea
                                id="description"
                                className="form-control"
                                placeholder="Enter Description..."
                                value={this.state.description}
                                onChange={event =>
                                    this.setDescription(
                                        event
                                    )
                                }
                            />
                        </div>
                    </div>
                    <div className="row mb-2">
                        <div className="col">Total:</div>
                        <div className="col text-right">
                            {window.APP.currency_symbol} {this.getTotal(cart)}
                        </div>
                    </div>
                    <div className="row">
                        <div className="col">
                            <button
                                type="button"
                                className="btn btn-danger btn-block"
                                onClick={this.handleEmptyCart}
                                disabled={!cart.length}
                            >
                                Cancel
                            </button>
                        </div>
                        <div className="col">
                            <button
                                type="button"
                                className="btn btn-primary btn-block"
                                disabled={!cart.length}
                                onClick={this.handleClickSubmit}
                            >
                                Submit
                            </button>
                        </div>
                    </div>
                </div>
                <div className="col-md-6 col-lg-6">
                    <div className="mb-2">
                        <input
                            type="text"
                            className="form-control"
                            placeholder="Search Product..."
                            onChange={this.handleChangeSearch}
                            onKeyDown={this.handleSeach}
                        />
                    </div>
                    <div className="order-product">
                        {products.map(p => (
                            <div
                                onClick={() => this.addProductToCart(p.barcode)}
                                key={p.id}
                                className="item"
                            >
                                <img src={p.image_url} alt="" />
                                <h5 style={window.APP.warning_quantity > p.quantity ? { color: 'red' } : {}}>{p.name}({p.quantity})</h5>
                            </div>
                        ))}
                    </div>
                </div>
            </div>
        );
    }
}

export default CartPurchase;

if (document.getElementById("cart2")) {
    ReactDOM.render(<CartPurchase />, document.getElementById("cart2"));
}
