export default function Button({ children, className = "", ...props }) {
    return (
      <button className={`btn btn-lg ${className}`} {...props}>
        {children}
      </button>
    );
  }
  