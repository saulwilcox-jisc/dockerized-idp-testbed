import { useState, useEffect } from "react";
import axios from "axios";
import useAuth from "../context/auth";

const useAxiosGet = (url, options) => {
  const { authToken, setAuthToken } = useAuth();
  const [data, setData] = useState();
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState();
  let optionsWithHeader = options || {};

  if (authToken) {
    optionsWithHeader = {
      ...options,
      headers: { Authorization: `Bearer ${authToken.replace(/\"/g, "")}` },
    };
  }

  useEffect(() => {
    const fetchData = async () => {
      setLoading(true);

      try {
        const res = await axios(url, optionsWithHeader);
        if (res.data["@type"] === "hydra:Collection") {
          setData(res.data["hydra:member"]);
        } else {
          setData(res.data);
        }
        setLoading(false);
      } catch (err) {
        setError(err);
        if (err.response) {
          if (err.response.status === 401) {
            setAuthToken();
            localStorage.removeItem("token");
          }
        }
      }
    };

    fetchData();
  }, []);

  return { data, loading, error };
};

export default useAxiosGet;
