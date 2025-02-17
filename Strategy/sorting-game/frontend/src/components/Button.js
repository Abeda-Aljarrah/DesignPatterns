export default function Button({ children, className = "", ...props }) {
    return (
      <button className={`btn btn-md ${className}`} {...props}>
        {children}
      </button>
    );
  }
  