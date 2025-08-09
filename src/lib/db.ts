import { Pool } from "pg";

const pool = new Pool({
  connectionString: "postgresql://user:password@localhost:5432/postgres",
});

export default pool;
